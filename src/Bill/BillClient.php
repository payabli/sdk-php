<?php

namespace Payabli\Bill;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Bill\Requests\AddBillRequest;
use Payabli\Types\BillResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\GetBillResponse;
use Payabli\Types\BillOutData;
use Payabli\Types\EditBillResponse;
use Payabli\Bill\Requests\GetAttachedFromBillRequest;
use Payabli\Types\FileContent;
use Payabli\Bill\Requests\DeleteAttachedFromBillRequest;
use Payabli\Bill\Requests\SendToApprovalBillRequest;
use Payabli\Types\ModifyApprovalBillResponse;
use Payabli\Core\Json\JsonSerializer;
use Payabli\Bill\Requests\SetApprovedBillRequest;
use Payabli\Types\SetApprovedBillResponse;
use Payabli\Bill\Requests\ListBillsRequest;
use Payabli\Types\BillQueryResponse;
use Payabli\Bill\Requests\ListBillsOrgRequest;

class BillClient
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
     * Creates a bill in an entrypoint.
     *
     * Example:
     * ```php
     * $client->bill->addBill(
     *     '8cfec329267',
     *     new AddBillRequest([
     *         'body' => new BillOutData([
     *             'accountingField1' => 'MyInternalId',
     *             'attachments' => [
     *                 new FileContent([
     *                     'filename' => 'my-doc.pdf',
     *                     'ftype' => FileContentFtype::Pdf->value,
     *                     'furl' => 'https://mysite.com/my-doc.pdf',
     *                 ]),
     *             ],
     *             'billDate' => new DateTime('2024-07-01'),
     *             'billItems' => [
     *                 new BillItem([
     *                     'itemCategories' => [
     *                         'deposits',
     *                     ],
     *                     'itemCommodityCode' => '010',
     *                     'itemCost' => 5,
     *                     'itemDescription' => 'Deposit for materials',
     *                     'itemMode' => 0,
     *                     'itemProductCode' => 'M-DEPOSIT',
     *                     'itemProductName' => 'Materials deposit',
     *                     'itemQty' => 1,
     *                     'itemTaxAmount' => 7,
     *                     'itemTaxRate' => 0.075,
     *                     'itemTotalAmount' => 123,
     *                     'itemUnitOfMeasure' => 'SqFt',
     *                 ]),
     *             ],
     *             'billNumber' => 'ABC-123',
     *             'comments' => 'Deposit for materials',
     *             'dueDate' => new DateTime('2024-07-01'),
     *             'endDate' => new DateTime('2024-07-01'),
     *             'frequency' => Frequency::Monthly->value,
     *             'mode' => 0,
     *             'netAmount' => 3762.87,
     *             'status' => 1,
     *             'terms' => Terms::Net30->value,
     *             'vendor' => new BillOutDataVendor([
     *                 'vendorNumber' => 'VEN-123',
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param AddBillRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addBill(string $entry, AddBillRequest $request, ?array $options = null): ?BillResponse
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
                    path: "Bill/single/{$entry}",
                    method: HttpMethod::POST,
                    headers: $headers,
                    body: $request->body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return BillResponse::fromJson($json);
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
     * Retrieves a bill by ID from an entrypoint.
     *
     * Example:
     * ```php
     * $client->bill->getBill(
     *     285,
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBill(int $idBill, ?array $options = null): ?GetBillResponse
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
                    path: "Bill/{$idBill}",
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
                return GetBillResponse::fromJson($json);
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
     * Updates a bill by ID.
     *
     * Example:
     * ```php
     * $client->bill->editBill(
     *     285,
     *     new BillOutData([
     *         'billDate' => new DateTime('2025-07-01'),
     *         'netAmount' => 3762.87,
     *     ]),
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param BillOutData $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?EditBillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function editBill(int $idBill, BillOutData $request, ?array $options = null): ?EditBillResponse
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
                    path: "Bill/{$idBill}",
                    method: HttpMethod::PUT,
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
                return EditBillResponse::fromJson($json);
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
     * Deletes a bill by ID.
     *
     * Example:
     * ```php
     * $client->bill->deleteBill(
     *     285,
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deleteBill(int $idBill, ?array $options = null): ?BillResponse
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
                    path: "Bill/{$idBill}",
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
                return BillResponse::fromJson($json);
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
     * Retrieves a file attached to a bill, either as a binary file or as a Base64-encoded string.
     *
     * Example:
     * ```php
     * $client->bill->getAttachedFromBill(
     *     285,
     *     '0_Bill.pdf',
     *     new GetAttachedFromBillRequest([
     *         'returnObject' => true,
     *     ]),
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * The filename in Payabli. Get this from the `zipName` field
     * in the `DocumentsRef.filelist` array returned by
     * `/api/Bill/{idBill}`. Example: `0_Bill.pdf`.
     *
     * @param string $filename
     * @param GetAttachedFromBillRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?FileContent
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getAttachedFromBill(int $idBill, string $filename, GetAttachedFromBillRequest $request = new GetAttachedFromBillRequest(), ?array $options = null): ?FileContent
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->returnObject != null) {
            $query['returnObject'] = $request->returnObject;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Bill/attachedFileFromBill/{$idBill}/{$filename}",
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
                return FileContent::fromJson($json);
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
     * Delete a file attached to a bill.
     *
     * Example:
     * ```php
     * $client->bill->deleteAttachedFromBill(
     *     285,
     *     '0_Bill.pdf',
     *     new DeleteAttachedFromBillRequest([]),
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * The filename in Payabli. Get this from the `zipName` field
     * in the `DocumentsRef.filelist` array returned by
     * `/api/Bill/{idBill}`. Example: `0_Bill.pdf`.
     *
     * @param string $filename
     * @param DeleteAttachedFromBillRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deleteAttachedFromBill(int $idBill, string $filename, DeleteAttachedFromBillRequest $request = new DeleteAttachedFromBillRequest(), ?array $options = null): ?BillResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->returnObject != null) {
            $query['returnObject'] = $request->returnObject;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Bill/attachedFileFromBill/{$idBill}/{$filename}",
                    method: HttpMethod::DELETE,
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
                return BillResponse::fromJson($json);
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
     * Send a bill to a user or list of users to approve.
     *
     * Example:
     * ```php
     * $client->bill->sendToApprovalBill(
     *     285,
     *     new SendToApprovalBillRequest([
     *         'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
     *         'body' => [
     *             'approver@example.com',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param SendToApprovalBillRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function sendToApprovalBill(int $idBill, SendToApprovalBillRequest $request, ?array $options = null): ?BillResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->autocreateUser != null) {
            $query['autocreateUser'] = $request->autocreateUser;
        }
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Bill/approval/{$idBill}",
                    method: HttpMethod::POST,
                    headers: $headers,
                    query: $query,
                    body: $request->body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return BillResponse::fromJson($json);
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
     * Modify the list of users the bill is sent to for approval.
     *
     * Example:
     * ```php
     * $client->bill->modifyApprovalBill(
     *     285,
     *     [
     *         'approver1@example.com',
     *         'approver2@example.com',
     *     ],
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param array<string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ModifyApprovalBillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function modifyApprovalBill(int $idBill, array $request, ?array $options = null): ?ModifyApprovalBillResponse
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
                    path: "Bill/approval/{$idBill}",
                    method: HttpMethod::PUT,
                    body: JsonSerializer::serializeArray($request, ['string']),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ModifyApprovalBillResponse::fromJson($json);
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
     * Approve or disapprove a bill by ID.
     *
     * Example:
     * ```php
     * $client->bill->setApprovedBill(
     *     285,
     *     'true',
     *     new SetApprovedBillRequest([]),
     * );
     * ```
     *
     * @param int $idBill Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
     * @param string $approved String representing the approved status. Accepted values: 'true' or 'false'.
     * @param SetApprovedBillRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetApprovedBillResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function setApprovedBill(int $idBill, string $approved, SetApprovedBillRequest $request = new SetApprovedBillRequest(), ?array $options = null): ?SetApprovedBillResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->email != null) {
            $query['email'] = $request->email;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Bill/approval/{$idBill}/{$approved}",
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
                return SetApprovedBillResponse::fromJson($json);
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
     * Retrieve a list of bills for an entrypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
     *
     * Example:
     * ```php
     * $client->bill->listBills(
     *     '8cfec329267',
     *     new ListBillsRequest([
     *         'fromRecord' => 251,
     *         'limitRecord' => 0,
     *         'sortBy' => 'desc(field_name)',
     *     ]),
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ListBillsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillQueryResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBills(string $entry, ListBillsRequest $request = new ListBillsRequest(), ?array $options = null): ?BillQueryResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->exportFormat != null) {
            $query['exportFormat'] = $request->exportFormat;
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
                    path: "Query/bills/{$entry}",
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
                return BillQueryResponse::fromJson($json);
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
     * Retrieve a list of bills for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
     *
     * Example:
     * ```php
     * $client->bill->listBillsOrg(
     *     123,
     *     new ListBillsOrgRequest([
     *         'fromRecord' => 251,
     *         'limitRecord' => 0,
     *         'sortBy' => 'desc(field_name)',
     *     ]),
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ListBillsOrgRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillQueryResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBillsOrg(int $orgId, ListBillsOrgRequest $request = new ListBillsOrgRequest(), ?array $options = null): ?BillQueryResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->exportFormat != null) {
            $query['exportFormat'] = $request->exportFormat;
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
                    path: "Query/bills/org/{$orgId}",
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
                return BillQueryResponse::fromJson($json);
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
