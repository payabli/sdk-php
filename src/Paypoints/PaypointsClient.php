<?php

namespace Payabli\Paypoints;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Paypoints\Requests\ListPaypointsPaypointsRequest;
use Payabli\Types\ListPaypointsEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\CreatePaypointWithBusinessReference;
use Payabli\Types\CreatePaypointWithInlineBusiness;
use Payabli\Types\CreatePaypointAllFields;
use Payabli\Types\PaypointCreatedEnvelope;
use Payabli\Core\Json\JsonSerializer;
use Payabli\Core\Types\Union;
use Payabli\Types\PaypointDetailEnvelope;
use Payabli\Paypoints\Requests\UpdatePaypointRequest;
use Payabli\Types\PaypointUpdatedEnvelope;

class PaypointsClient
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
     * Lists paypoints with optional filtering and pagination.
     *
     * Example:
     * ```php
     * $client->paypoints->listPaypoints(
     *     new ListPaypointsPaypointsRequest([
     *         'limit' => 1,
     *         'page' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListPaypointsPaypointsRequest $request
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
    public function listPaypoints(ListPaypointsPaypointsRequest $request = new ListPaypointsPaypointsRequest(), ?array $options = null): ?ListPaypointsEnvelope
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
                    path: "v2/paypoints",
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
     * Creates a paypoint. New paypoints start in `pending`. Provide exactly
     * one of `businessReference` (an existing business) or `business` (to
     * create the business inline).
     *
     * Example:
     * ```php
     * $client->paypoints->createPaypoint(
     *     new CreatePaypointWithBusinessReference([
     *         'paypointType' => 'merchant',
     *         'doingBusinessAs' => 'Rose Gardens',
     *         'description' => 'Boutique flower shop',
     *         'website' => 'https://example.com',
     *         'customerServicePhone' => '3055551212',
     *         'customerServiceEmail' => 'support@example.com',
     *         'timezone' => 'America/New_York',
     *         'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     ]),
     * );
     * ```
     *
     * @param (
     *    CreatePaypointWithBusinessReference
     *   |CreatePaypointWithInlineBusiness
     *   |CreatePaypointAllFields
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
    public function createPaypoint(CreatePaypointWithBusinessReference|CreatePaypointWithInlineBusiness|CreatePaypointAllFields $request, ?array $options = null): ?PaypointCreatedEnvelope
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
                    path: "v2/paypoints",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(CreatePaypointWithBusinessReference::class, CreatePaypointWithInlineBusiness::class, CreatePaypointAllFields::class)),
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
     * Retrieves a paypoint by reference.
     *
     * Example:
     * ```php
     * $client->paypoints->getPaypoint(
     *     '019ff064-c690-7679-a73e-688418aadc7c',
     * );
     * ```
     *
     * @param string $paypointReference The paypoint reference.
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
    public function getPaypoint(string $paypointReference, ?array $options = null): ?PaypointDetailEnvelope
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
                    path: "v2/paypoints/{$paypointReference}",
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
     * Applies a partial update to a paypoint. Send only the fields you want to change.
     *
     * Example:
     * ```php
     * $client->paypoints->updatePaypoint(
     *     '019ff064-c690-7679-a73e-688418aadc7c',
     *     new UpdatePaypointRequest([
     *         'description' => 'Updated description',
     *     ]),
     * );
     * ```
     *
     * @param string $paypointReference The paypoint reference.
     * @param UpdatePaypointRequest $request
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
    public function updatePaypoint(string $paypointReference, UpdatePaypointRequest $request = new UpdatePaypointRequest(), ?array $options = null): ?PaypointUpdatedEnvelope
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
                    path: "v2/paypoints/{$paypointReference}",
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
