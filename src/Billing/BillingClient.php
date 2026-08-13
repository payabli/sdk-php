<?php

namespace Payabli\Billing;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Billing\Requests\ListBillingProfilesRequest;
use Payabli\Types\BillingProfileQueryResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Billing\Types\GetProfileBillingRequestServiceGroup;
use Payabli\Billing\Types\GetProfileBillingRequestEntityType;
use Payabli\Types\BillingProfileResponse;

class BillingClient
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
     * Returns every billing profile that belongs to an organization. This is
     * the data behind the Profile Library table in the Payabli Portal.
     *
     * Requires a token with the `billing_profile_read` permission; a token
     * without it gets `403 Forbidden`.
     *
     * Example:
     * ```php
     * $client->billing->listProfiles(
     *     123,
     *     new ListBillingProfilesRequest([
     *         'limitRecord' => 20,
     *         'fromRecord' => 0,
     *     ]),
     * );
     * ```
     *
     * @param int $orgId The organization's numeric identifier.
     * @param ListBillingProfilesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillingProfileQueryResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listProfiles(int $orgId, ListBillingProfilesRequest $request = new ListBillingProfilesRequest(), ?array $options = null): ?BillingProfileQueryResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->profileName != null) {
            $query['profileName'] = $request->profileName;
        }
        if ($request->feeType != null) {
            $query['feeType'] = $request->feeType;
        }
        if ($request->serviceVertical != null) {
            $query['serviceVertical'] = $request->serviceVertical;
        }
        if ($request->profileId != null) {
            $query['profileId'] = $request->profileId;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "billing/configuration/org/{$orgId}",
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
                return BillingProfileQueryResponse::fromJson($json);
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
     * Returns the billing profile currently assigned to an entity, including
     * its billable events and fee schedules. Use it to read the pricing terms
     * in effect for an organization, paypoint, template, or application.
     *
     * Requires a token with the `billing_profile_read` permission and access
     * to the requested entity; otherwise the call gets `403 Forbidden`.
     *
     * If the entity exists but has no profile assigned, the call returns
     * `404 Not Found`.
     *
     * Example:
     * ```php
     * $client->billing->getProfile(
     *     GetProfileBillingRequestServiceGroup::PayIn->value,
     *     GetProfileBillingRequestEntityType::Organization->value,
     *     123,
     * );
     * ```
     *
     * The billing vertical. Only `PayIn` and `PayOut` are accepted; any
     * other value returns `400 Bad Request`.
     *
     * @param value-of<GetProfileBillingRequestServiceGroup> $serviceGroup
     * The owning entity type: `Organization`, `Paypoint`, `Template`, or
     * `Application`.
     *
     * @param value-of<GetProfileBillingRequestEntityType> $entityType
     * @param int $entityId The numeric identifier of the entity.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillingProfileResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getProfile(string $serviceGroup, string $entityType, int $entityId, ?array $options = null): ?BillingProfileResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "billing/configuration/{$serviceGroup}/{$entityType}/{$entityId}",
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
                return BillingProfileResponse::fromJson($json);
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
