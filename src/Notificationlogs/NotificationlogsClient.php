<?php

namespace Payabli\Notificationlogs;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Notificationlogs\Requests\SearchNotificationLogsRequest;
use Payabli\Types\NotificationLog;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use Payabli\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\NotificationLogDetail;
use Payabli\Core\Json\JsonSerializer;

class NotificationlogsClient
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
     * Search notification logs with filtering and pagination.
     *   - Start date and end date cannot be more than 30 days apart
     *   - Either `orgId` or `paypointId` must be provided
     *
     * This endpoint requires the `notifications_create` OR `notifications_read` permission.
     *
     * Example:
     * ```php
     * $client->notificationlogs->searchNotificationLogs(
     *     new SearchNotificationLogsRequest([
     *         'pageSize' => 20,
     *         'startDate' => new DateTime('2024-01-01T00:00:00Z'),
     *         'endDate' => new DateTime('2024-01-31T23:59:59Z'),
     *         'notificationEvent' => 'ActivatedMerchant',
     *         'succeeded' => true,
     *         'orgId' => 123,
     *     ]),
     * );
     * ```
     *
     * @param SearchNotificationLogsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<NotificationLog>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function searchNotificationLogs(SearchNotificationLogsRequest $request, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->pageSize != null) {
            $query['PageSize'] = $request->pageSize;
        }
        if ($request->page != null) {
            $query['Page'] = $request->page;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/notificationlogs",
                    method: HttpMethod::POST,
                    query: $query,
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
                return JsonDecoder::decodeArray($json, [NotificationLog::class]); // @phpstan-ignore-line
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
     * Get detailed information for a specific notification log entry.
     * This endpoint requires the `notifications_create` OR `notifications_read` permission.
     *
     * Example:
     * ```php
     * $client->notificationlogs->getNotificationLog(
     *     '550e8400-e29b-41d4-a716-446655440000',
     * );
     * ```
     *
     * @param string $uuid The notification log entry.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?NotificationLogDetail
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getNotificationLog(string $uuid, ?array $options = null): ?NotificationLogDetail
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
                    path: "v2/notificationlogs/{$uuid}",
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
                return NotificationLogDetail::fromJson($json);
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
     * Retry sending a specific notification.
     *
     * **Permissions:** notifications_create
     *
     * Example:
     * ```php
     * $client->notificationlogs->retryNotificationLog(
     *     '550e8400-e29b-41d4-a716-446655440000',
     * );
     * ```
     *
     * @param string $uuid Unique id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?NotificationLogDetail
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function retryNotificationLog(string $uuid, ?array $options = null): ?NotificationLogDetail
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
                    path: "v2/notificationlogs/{$uuid}/retry",
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
                return NotificationLogDetail::fromJson($json);
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
     * Retry sending multiple notifications (maximum 50 IDs).
     * This is an async process, so use the search endpoint again to check the notification status.
     *
     * This endpoint requires the `notifications_create` permission.
     *
     * Example:
     * ```php
     * $client->notificationlogs->bulkRetryNotificationLogs(
     *     [
     *         '550e8400-e29b-41d4-a716-446655440000',
     *         '550e8400-e29b-41d4-a716-446655440001',
     *         '550e8400-e29b-41d4-a716-446655440002',
     *     ],
     * );
     * ```
     *
     * @param array<string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function bulkRetryNotificationLogs(array $request, ?array $options = null): void
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
                    path: "v2/notificationlogs/retry",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeArray($request, ['string']),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
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
