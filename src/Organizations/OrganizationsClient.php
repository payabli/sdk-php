<?php

namespace Payabli\Organizations;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Organizations\Requests\ListOrganizationsOrganizationsRequest;
use Payabli\Types\ListPaypointsEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\CreateOrganizationWithInlineBusiness;
use Payabli\Types\CreateOrganizationWithBusinessReference;
use Payabli\Types\CreateOrganizationAllFields;
use Payabli\Types\PaypointCreatedEnvelope;
use Payabli\Core\Json\JsonSerializer;
use Payabli\Core\Types\Union;
use Payabli\Types\PaypointDetailEnvelope;
use Payabli\Organizations\Requests\UpdateOrganizationRequest;
use Payabli\Types\PaypointUpdatedEnvelope;

class OrganizationsClient
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @var ?RoutingAuthProvider $routingAuthProvider @phpstan-ignore-next-line Property is read in endpoint methods and passed to subclients
     */
    private ?RoutingAuthProvider $routingAuthProvider;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     * @param ?RoutingAuthProvider $routingAuthProvider
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
        ?RoutingAuthProvider $routingAuthProvider = null,
    ) {
        $this->client = $client;
        $this->routingAuthProvider = $routingAuthProvider;
        $this->options = $options ?? [];
    }

    /**
     * Lists organizations with optional filtering and pagination. Only
     * organizations are returned. Other paypoints never appear in this list.
     *
     * Example:
     * ```php
     * $client->organizations->listOrganizations(
     *     new ListOrganizationsOrganizationsRequest([
     *         'businessReference' => '6e2b9d14-7a3c-4f58-b1e6-0c9d3a5f8e27',
     *     ]),
     * );
     * ```
     *
     * @param ListOrganizationsOrganizationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPaypointsEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listOrganizations(ListOrganizationsOrganizationsRequest $request = new ListOrganizationsOrganizationsRequest(), ?array $options = null): ?ListPaypointsEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->businessReference != null) {
            $query['businessReference'] = $request->businessReference;
        }
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->search != null) {
            $query['search'] = $request->search;
        }
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/organizations",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListPaypointsEnvelope::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new PayabliException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new PayabliException(message: $e->getMessage(), previous: $e);
        }
        throw new PayabliApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Creates an organization. Provide exactly one of `business` (to create
     * the business inline, recommended) or `businessReference` (an existing
     * business). In intelligent boarding, an organization is a kind of paypoint, so the
     * request takes the paypoint create fields except `paypointType`. Payabli
     * sets the organization type itself. An organization isn't underwritten,
     * so only the fields needed to create the records are required. New
     * organizations start in `pending`. If you don't set
     * `parentPaypointReference`, the organization nests under the
     * organization your credential belongs to. Returns `409` if an
     * organization with the same `externalId` already exists.
     *
     * Example:
     * ```php
     * $client->organizations->createOrganization(
     *     new CreateOrganizationWithInlineBusiness([
     *         'doingBusinessAs' => 'PropertyManager Pro',
     *         'description' => 'Property management software partner',
     *         'website' => 'https://example.com',
     *         'customerServicePhone' => '3055551212',
     *         'customerServiceEmail' => 'support@example.com',
     *         'timezone' => 'America/New_York',
     *         'externalId' => 'pmp-org-001',
     *         'business' => new CreateBusinessRequest([
     *             'externalId' => 'pmp-biz-001',
     *             'legalName' => 'PropertyManager Pro LLC',
     *             'legalStructure' => CreateBusinessRequestLegalStructure::Llc->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param (
     *    CreateOrganizationWithInlineBusiness
     *   |CreateOrganizationWithBusinessReference
     *   |CreateOrganizationAllFields
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaypointCreatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createOrganization(CreateOrganizationWithInlineBusiness|CreateOrganizationWithBusinessReference|CreateOrganizationAllFields $request, ?array $options = null): ?PaypointCreatedEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/organizations",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(CreateOrganizationWithInlineBusiness::class, CreateOrganizationWithBusinessReference::class, CreateOrganizationAllFields::class)),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PaypointCreatedEnvelope::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new PayabliException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new PayabliException(message: $e->getMessage(), previous: $e);
        }
        throw new PayabliApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieves an organization by reference.
     *
     * Example:
     * ```php
     * $client->organizations->getOrganization(
     *     'a8806f02-23b3-4f6d-bba3-42e1b94326ea',
     * );
     * ```
     *
     * @param string $organizationReference The organization reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaypointDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getOrganization(string $organizationReference, ?array $options = null): ?PaypointDetailEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/organizations/{$organizationReference}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PaypointDetailEnvelope::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new PayabliException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new PayabliException(message: $e->getMessage(), previous: $e);
        }
        throw new PayabliApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Applies a partial update to an organization. Send only the fields you want to change. You can't change an organization's type. If you send `paypointType`, the request ignores it and doesn't return an error.
     *
     * Example:
     * ```php
     * $client->organizations->updateOrganization(
     *     'a8806f02-23b3-4f6d-bba3-42e1b94326ea',
     *     new UpdateOrganizationRequest([
     *         'description' => 'Updated description',
     *     ]),
     * );
     * ```
     *
     * @param string $organizationReference The organization reference.
     * @param UpdateOrganizationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaypointUpdatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateOrganization(string $organizationReference, UpdateOrganizationRequest $request = new UpdateOrganizationRequest(), ?array $options = null): ?PaypointUpdatedEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/organizations/{$organizationReference}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PaypointUpdatedEnvelope::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new PayabliException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new PayabliException(message: $e->getMessage(), previous: $e);
        }
        throw new PayabliApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
