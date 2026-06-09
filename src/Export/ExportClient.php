<?php

namespace Payabli\Export;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Types\ExportFormat1;
use Payabli\Export\Requests\ExportApplicationsRequest;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use Payabli\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Export\Requests\ExportBatchDetailsRequest;
use Payabli\Export\Requests\ExportBatchDetailsOrgRequest;
use Payabli\Export\Requests\ExportBatchesRequest;
use Payabli\Export\Requests\ExportBatchesOrgRequest;
use Payabli\Export\Requests\ExportBatchesOutRequest;
use Payabli\Export\Requests\ExportBatchesOutOrgRequest;
use Payabli\Export\Requests\ExportBillsRequest;
use Payabli\Export\Requests\ExportBillsOrgRequest;
use Payabli\Export\Requests\ExportChargebacksRequest;
use Payabli\Export\Requests\ExportChargebacksOrgRequest;
use Payabli\Export\Requests\ExportCustomersRequest;
use Payabli\Export\Requests\ExportCustomersOrgRequest;
use Payabli\Export\Requests\ExportInvoicesRequest;
use Payabli\Export\Requests\ExportInvoicesOrgRequest;
use Payabli\Export\Requests\ExportOrganizationsRequest;
use Payabli\Export\Requests\ExportPayoutRequest;
use Payabli\Export\Requests\ExportPayoutOrgRequest;
use Payabli\Export\Requests\ExportPaypointsRequest;
use Payabli\Export\Requests\ExportSettlementsRequest;
use Payabli\Export\Requests\ExportSettlementsOrgRequest;
use Payabli\Export\Requests\ExportSubscriptionsRequest;
use Payabli\Export\Requests\ExportSubscriptionsOrgRequest;
use Payabli\Export\Requests\ExportTransactionsRequest;
use Payabli\Export\Requests\ExportTransactionsOrgRequest;
use Payabli\Export\Requests\ExportTransferDetailsRequest;
use Payabli\Export\Requests\ExportTransfersRequest;
use Payabli\Export\Requests\ExportVendorsRequest;
use Payabli\Export\Requests\ExportVendorsOrgRequest;

class ExportClient
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
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List all apps for org](/developers/api-reference/boarding/get-list-of-applications-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of boarding applications for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportApplicationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportApplications(string $format, int $orgId, ExportApplicationsRequest $request = new ExportApplicationsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/boarding/{$format}/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List batch details](/developers/api-reference/query/get-list-of-batchdetails-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export batch details for a paypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportBatchDetailsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatchDetails(string $format, string $entry, ExportBatchDetailsRequest $request = new ExportBatchDetailsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batchDetails/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List batch details for org](/developers/api-reference/query/get-list-of-batchdetails-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export batch details for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportBatchDetailsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatchDetailsOrg(string $format, int $orgId, ExportBatchDetailsOrgRequest $request = new ExportBatchDetailsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batchDetails/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List batches for paypoint](/developers/api-reference/query/get-list-of-batches-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of batches for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportBatchesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatches(string $format, string $entry, ExportBatchesRequest $request = new ExportBatchesRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batches/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List batches for org](/developers/api-reference/query/get-list-of-batches-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of batches for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportBatchesOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatchesOrg(string $format, int $orgId, ExportBatchesOrgRequest $request = new ExportBatchesOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batches/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List payout batches for paypoint](/developers/api-reference/query/get-list-of-moneyout-batches-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of money out batches for a paypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportBatchesOutRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatchesOut(string $format, string $entry, ExportBatchesOutRequest $request = new ExportBatchesOutRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batchesOut/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List payout batches for org](/developers/api-reference/query/get-list-of-moneyout-batches-for-an-org) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of money out batches for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportBatchesOutOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBatchesOutOrg(string $format, int $orgId, ExportBatchesOutOrgRequest $request = new ExportBatchesOutOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/batchesOut/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List bills by paypoint](/developers/api-reference/bill/get-list-of-bills-for-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of bills for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportBillsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBills(string $format, string $entry, ExportBillsRequest $request = new ExportBillsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/bills/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List bills by organization](/developers/api-reference/bill/get-list-of-bills-for-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of bills for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportBillsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportBillsOrg(string $format, int $orgId, ExportBillsOrgRequest $request = new ExportBillsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/bills/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List disputes by paypoint](/developers/api-reference/chargebacks/get-list-of-chargebacks-and-returned-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of chargebacks and ACH returns for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportChargebacksRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportChargebacks(string $format, string $entry, ExportChargebacksRequest $request = new ExportChargebacksRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/chargebacks/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List disputes by organization](/developers/api-reference/chargebacks/get-list-of-chargebacks-and-returned-transactions-for-an-org) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of chargebacks and ACH returns for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportChargebacksOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportChargebacksOrg(string $format, int $orgId, ExportChargebacksOrgRequest $request = new ExportChargebacksOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/chargebacks/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List customers by paypoint](/developers/api-reference/customer/get-list-of-customers-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of customers for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportCustomersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportCustomers(string $format, string $entry, ExportCustomersRequest $request = new ExportCustomersRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/customers/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List customers by organization](/developers/api-reference/customer/get-list-of-customers-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Exports a list of customers for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportCustomersOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportCustomersOrg(string $format, int $orgId, ExportCustomersOrgRequest $request = new ExportCustomersOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/customers/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List invoices by paypoint](/developers/api-reference/invoice/get-list-of-invoices-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export list of invoices for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportInvoicesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportInvoices(string $format, string $entry, ExportInvoicesRequest $request = new ExportInvoicesRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/invoices/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List invoices by organization](/developers/api-reference/invoice/get-list-of-invoices-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of invoices for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportInvoicesOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportInvoicesOrg(string $format, int $orgId, ExportInvoicesOrgRequest $request = new ExportInvoicesOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/invoices/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List suborganizations by organization](/developers/api-reference/organization/get-list-of-organizations-for-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of child organizations (suborganizations) for a parent organization.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportOrganizationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportOrganizations(string $format, int $orgId, ExportOrganizationsRequest $request = new ExportOrganizationsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/organizations/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List payouts by paypoint](/developers/api-reference/query/get-list-of-payouts-for-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of payouts and their statuses for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportPayoutRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportPayout(string $format, string $entry, ExportPayoutRequest $request = new ExportPayoutRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/payouts/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List payouts by org](/developers/api-reference/query/get-list-of-payouts-for-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of payouts and their details for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportPayoutOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportPayoutOrg(string $format, int $orgId, ExportPayoutOrgRequest $request = new ExportPayoutOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/payouts/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List paypoints by organization](/developers/api-reference/paypoint/get-list-of-paypoints-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of paypoints in an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportPaypointsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportPaypoints(string $format, int $orgId, ExportPaypointsRequest $request = new ExportPaypointsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/paypoints/{$format}/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List settled transactions for paypoint](/developers/api-reference/query/get-list-of-settled-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of settled transactions for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportSettlementsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportSettlements(string $format, string $entry, ExportSettlementsRequest $request = new ExportSettlementsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/settlements/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List settled transactions for org](/developers/api-reference/query/get-list-of-settled-transactions-for-an-org) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of settled transactions for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportSettlementsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportSettlementsOrg(string $format, int $orgId, ExportSettlementsOrgRequest $request = new ExportSettlementsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/settlements/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List subscriptions by paypoint](/developers/api-reference/subscription/get-list-of-subscriptions-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of subscriptions for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportSubscriptionsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportSubscriptions(string $format, string $entry, ExportSubscriptionsRequest $request = new ExportSubscriptionsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/subscriptions/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List subscriptions by organization](/developers/api-reference/subscription/get-list-of-subscriptions-for-an-org) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of subscriptions for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportSubscriptionsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportSubscriptionsOrg(string $format, int $orgId, ExportSubscriptionsOrgRequest $request = new ExportSubscriptionsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/subscriptions/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List transactions for paypoint](/developers/api-reference/query/get-list-of-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of transactions for an entrypoint in a file in XLSX or CSV format. Use filters to limit results. If you don't specify a date range in the request, the last two months of data are returned.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportTransactionsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportTransactions(string $format, string $entry, ExportTransactionsRequest $request = new ExportTransactionsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/transactions/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List transactions for org](/developers/api-reference/query/get-list-of-transactions-for-an-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of transactions for an org in a file in XLSX or CSV format. Use filters to limit results. If you don't specify a date range in the request, the last two months of data are returned.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportTransactionsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportTransactionsOrg(string $format, int $orgId, ExportTransactionsOrgRequest $request = new ExportTransactionsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/transactions/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [Get transfer details](/developers/api-reference/query/get-list-of-transfer-details) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of transfer details for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param int $transferId Transfer identifier.
     * @param ExportTransferDetailsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportTransferDetails(string $format, string $entry, int $transferId, ExportTransferDetailsRequest $request = new ExportTransferDetailsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/transferDetails/{$format}/{$entry}/{$transferId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List transfers](/developers/api-reference/query/get-list-of-transfers) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Get a list of transfers for an entrypoint. Use filters to limit results.
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportTransfersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportTransfers(string $entry, ExportTransfersRequest $request = new ExportTransfersRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/transfers/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List vendors by paypoint](/developers/api-reference/vendor/get-list-of-vendors-for-entrypoint) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of vendors for an entrypoint. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ExportVendorsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportVendors(string $format, string $entry, ExportVendorsRequest $request = new ExportVendorsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/vendors/{$format}/{$entry}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
     * <Warning>
     *   This endpoint is deprecated. To export this data, use [List vendors by organization](/developers/api-reference/vendor/get-list-of-vendors-for-organization) with the `exportFormat` query parameter instead.
     * </Warning>
     *
     * Export a list of vendors for an organization. Use filters to limit results.
     *
     * @param value-of<ExportFormat1> $format Format for the export, either XLSX or CSV.
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ExportVendorsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function exportVendorsOrg(string $format, int $orgId, ExportVendorsOrgRequest $request = new ExportVendorsOrgRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->columnsExport != null) {
            $query['columnsExport'] = $request->columnsExport;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Export/vendors/{$format}/org/{$orgId}",
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
                return JsonDecoder::decodeArray($json, ['string' => 'mixed']); // @phpstan-ignore-line
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
