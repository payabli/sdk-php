<?php

namespace Payabli\Statistic;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Statistic\Requests\BasicStatsRequest;
use Payabli\Types\StatBasicExtendedQueryRecord;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use Payabli\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Statistic\Requests\CustomerBasicStatsRequest;
use Payabli\Types\SubscriptionStatsQueryRecord;
use Payabli\Statistic\Requests\SubStatsRequest;
use Payabli\Types\StatBasicQueryRecord;
use Payabli\Statistic\Requests\VendorBasicStatsRequest;
use Payabli\Types\StatisticsVendorQueryRecord;

class StatisticClient
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
     * Retrieves the basic statistics for an organization or a paypoint, for a given time period, grouped by a particular frequency.
     *
     * Example:
     * ```php
     * $client->statistic->basicStats(
     *     'custom',
     *     'm',
     *     2,
     *     1000000,
     *     new BasicStatsRequest([
     *         'startDate' => '2025-11-01',
     *         'endDate' => '2025-11-30',
     *     ]),
     * );
     * ```
     *
     * Mode for the request. Allowed values:
     *
     * - `custom` - Allows you to set a custom date range
     * - `ytd` - Year To Date
     * - `mtd` - Month To Date
     * - `wtd` - Week To Date
     * - `today` - All current day
     * - `m12` - Last 12 months
     * - `d30` - Last 30 days
     * - `h24` - Last 24 hours
     * - `lasty` - Last Year
     * - `lastm` - Last Month
     * - `lastw` - Last Week
     * - `yesterday` - Last Day
     *
     * @param string $mode
     * Frequency to group series. Allowed values:
     *
     * - `m` - monthly
     * - `w` - weekly
     * - `d` - daily
     * - `h` - hourly
     *
     * For example, `w` groups the results by week.
     *
     * @param string $freq
     * The entry level for the request:
     *   - 0 for Organization
     *   - 2 for Paypoint
     *
     * @param int $level
     * @param int $entryId Identifier in Payabli for the entity.
     * @param BasicStatsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<StatBasicExtendedQueryRecord>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function basicStats(string $mode, string $freq, int $level, int $entryId, BasicStatsRequest $request = new BasicStatsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->endDate != null) {
            $query['endDate'] = $request->endDate;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        if ($request->startDate != null) {
            $query['startDate'] = $request->startDate;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Statistic/basic/{$mode}/{$freq}/{$level}/{$entryId}",
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
                return JsonDecoder::decodeArray($json, [StatBasicExtendedQueryRecord::class]); // @phpstan-ignore-line
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
     * Retrieves the basic statistics for a customer for a specific time period, grouped by a selected frequency.
     *
     * Example:
     * ```php
     * $client->statistic->customerBasicStats(
     *     'ytd',
     *     'm',
     *     4440,
     *     new CustomerBasicStatsRequest([]),
     * );
     * ```
     *
     * Mode for request. Allowed values:
     *
     * - `ytd` - Year To Date
     * - `mtd` - Month To Date
     * - `wtd` - Week To Date
     * - `today` - All current day
     * - `m12` - Last 12 months
     * - `d30` - Last 30 days
     * - `h24` - Last 24 hours
     * - `lasty` - Last Year
     * - `lastm` - Last Month
     * - `lastw` - Last Week
     * - `yesterday` - Last Day
     *
     * @param string $mode
     * Frequency to group series. Allowed values:
     *
     * - `m` - monthly
     * - `w` - weekly
     * - `d` - daily
     * - `h` - hourly
     *
     * For example, `w` groups the results by week.
     *
     * @param string $freq
     * @param int $customerId Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
     * @param CustomerBasicStatsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<SubscriptionStatsQueryRecord>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function customerBasicStats(string $mode, string $freq, int $customerId, CustomerBasicStatsRequest $request = new CustomerBasicStatsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Statistic/customerbasic/{$mode}/{$freq}/{$customerId}",
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
                return JsonDecoder::decodeArray($json, [SubscriptionStatsQueryRecord::class]); // @phpstan-ignore-line
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
     * Retrieves the subscription statistics for a given interval for a paypoint or organization.
     *
     * Example:
     * ```php
     * $client->statistic->subStats(
     *     '30',
     *     2,
     *     1000000,
     *     new SubStatsRequest([]),
     * );
     * ```
     *
     * Interval to get the data. Allowed values:
     *
     * - `all` - all intervals
     * - `30` - 1-30 days
     * - `60` - 31-60 days
     * - `90` - 61-90 days
     * - `plus` - +90 days
     *
     * @param string $interval
     * The entry level for the request:
     *   - 0 for Organization
     *   - 2 for Paypoint
     *
     * @param int $level
     * @param int $entryId Identifier in Payabli for the entity.
     * @param SubStatsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<StatBasicQueryRecord>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function subStats(string $interval, int $level, int $entryId, SubStatsRequest $request = new SubStatsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Statistic/subscriptions/{$interval}/{$level}/{$entryId}",
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
                return JsonDecoder::decodeArray($json, [StatBasicQueryRecord::class]); // @phpstan-ignore-line
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
     * Retrieve the basic statistics about a vendor for a given time period, grouped by frequency.
     *
     * Example:
     * ```php
     * $client->statistic->vendorBasicStats(
     *     'ytd',
     *     'm',
     *     1,
     *     new VendorBasicStatsRequest([]),
     * );
     * ```
     *
     * Mode for request. Allowed values:
     *
     * - `ytd` - Year To Date
     * - `mtd` - Month To Date
     * - `wtd` - Week To Date
     * - `today` - All current day
     * - `m12` - Last 12 months
     * - `d30` - Last 30 days
     * - `h24` - Last 24 hours
     * - `lasty` - Last Year
     * - `lastm` - Last Month
     * - `lastw` - Last Week
     * - `yesterday` - Last Day
     *
     * @param string $mode
     * Frequency to group series. Allowed values:
     *
     * - `m` - monthly
     * - `w` - weekly
     * - `d` - daily
     * - `h` - hourly
     *
     * For example, `w` groups the results by week.
     *
     * @param string $freq
     * @param int $idVendor Vendor ID.
     * @param VendorBasicStatsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<StatisticsVendorQueryRecord>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function vendorBasicStats(string $mode, string $freq, int $idVendor, VendorBasicStatsRequest $request = new VendorBasicStatsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Statistic/vendorbasic/{$mode}/{$freq}/{$idVendor}",
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
                return JsonDecoder::decodeArray($json, [StatisticsVendorQueryRecord::class]); // @phpstan-ignore-line
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
