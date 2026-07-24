<?php

namespace Payabli\Cloud;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Cloud\Requests\DeviceEntry;
use Payabli\Types\AddDeviceResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\RemoveDeviceResponse;
use Payabli\Types\CloudQueryApiResponse;
use Payabli\Cloud\Requests\ListDeviceRequest;

class CloudClient
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
     * Register a cloud device to an entrypoint. See [Devices Quickstart](/developers/developer-guides/devices-quickstart#devices-quickstart) for a complete guide.
     *
     * Example:
     * ```php
     * $client->cloud->addDevice(
     *     '8cfec329267',
     *     new DeviceEntry([
     *         'description' => 'Front Desk POS',
     *         'registrationCode' => 'YS7DS5',
     *     ]),
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param DeviceEntry $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddDeviceResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addDevice(string $entry, DeviceEntry $request = new DeviceEntry(), ?array $options = null): ?AddDeviceResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Cloud/register/{$entry}",
                    method: HttpMethod::POST,
                    headers: $headers,
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
                return AddDeviceResponse::fromJson($json);
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
     * Remove a cloud device from an entrypoint.
     *
     * Example:
     * ```php
     * $client->cloud->removeDevice(
     *     '8cfec329267',
     *     '499585-389fj484-3jcj8hj3',
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param string $deviceId ID of the cloud device.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RemoveDeviceResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function removeDevice(string $entry, string $deviceId, ?array $options = null): ?RemoveDeviceResponse
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
                    path: "Cloud/register/{$entry}/{$deviceId}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return RemoveDeviceResponse::fromJson($json);
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
     * Retrieve the registration history for a device.
     *
     * Example:
     * ```php
     * $client->cloud->historyDevice(
     *     '8cfec329267',
     *     '499585-389fj484-3jcj8hj3',
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param string $deviceId ID of the cloud device.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CloudQueryApiResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function historyDevice(string $entry, string $deviceId, ?array $options = null): ?CloudQueryApiResponse
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
                    path: "Cloud/history/{$entry}/{$deviceId}",
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
                return CloudQueryApiResponse::fromJson($json);
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
     * Use [List devices by paypoint](/developers/api-reference/cloud/get-list-of-devices-for-a-paypoint) instead, which supports filters, sorting, and pagination.
     *
     * Get a list of cloud devices registered to an entrypoint.
     *
     * Example:
     * ```php
     * $client->cloud->listDevice(
     *     '8cfec329267',
     *     new ListDeviceRequest([]),
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ListDeviceRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CloudQueryApiResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listDevice(string $entry, ListDeviceRequest $request = new ListDeviceRequest(), ?array $options = null): ?CloudQueryApiResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->forceRefresh != null) {
            $query['forceRefresh'] = $request->forceRefresh;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Cloud/list/{$entry}",
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
                return CloudQueryApiResponse::fromJson($json);
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
