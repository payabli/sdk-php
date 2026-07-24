<?php

namespace Payabli\Vendor;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Types\VendorData;
use Payabli\Types\PayabliApiResponseVendors;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\VendorQueryRecord;
use Payabli\Vendor\Requests\VendorEnrichRequest;
use Payabli\Types\VendorEnrichResponse;
use Payabli\Vendor\Requests\ScheduleEnrichmentCallRequest;
use Payabli\Types\VendorScheduleCallResponse;
use Payabli\Types\VendorCallStatusResponse;

class VendorClient
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
     * Creates a vendor in an entrypoint.
     *
     * Example:
     * ```php
     * $client->vendor->addVendor(
     *     '8cfec329267',
     *     new VendorData([
     *         'vendorNumber' => 'VEN-123',
     *         'address1' => '123 Ocean Drive',
     *         'address2' => 'Suite 400',
     *         'billingData' => new BillingData([
     *             'accountNumber' => '123123123',
     *             'bankAccountFunction' => 0,
     *             'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
     *             'bankAccountHolderType' => BankAccountHolderType::Business->value,
     *             'bankName' => 'Country Bank',
     *             'id' => 123,
     *             'routingAccount' => '123123123',
     *             'typeAccount' => TypeAccount::Checking->value,
     *         ]),
     *         'city' => 'Miami',
     *         'contacts' => [
     *             new Contacts([
     *                 'contactEmail' => 'example@email.com',
     *                 'contactName' => 'Herman Martinez',
     *                 'contactPhone' => '3055550000',
     *                 'contactTitle' => 'Owner',
     *             ]),
     *         ],
     *         'country' => 'US',
     *         'customerVendorAccount' => 'A-37622',
     *         'ein' => '12-3456789',
     *         'email' => 'example@email.com',
     *         'internalReferenceId' => 123,
     *         'locationCode' => 'MIA123',
     *         'mcc' => '7777',
     *         'name1' => "Herman's Coatings and Masonry",
     *         'name2' => '<string>',
     *         'payeeName1' => '<string>',
     *         'payeeName2' => '<string>',
     *         'paymentMethod' => 'managed',
     *         'phone' => '5555555555',
     *         'remitAddress1' => '123 Walnut Street',
     *         'remitAddress2' => 'Suite 900',
     *         'remitCity' => 'Miami',
     *         'remitCountry' => 'US',
     *         'remitState' => 'FL',
     *         'remitZip' => '31113',
     *         'state' => 'FL',
     *         'vendorStatus' => 1,
     *         'zip' => '33139',
     *     ]),
     * );
     * ```
     *
     * @param string $entry Entrypoint identifier.
     * @param VendorData $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponseVendors
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addVendor(string $entry, VendorData $request, ?array $options = null): ?PayabliApiResponseVendors
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
                    path: "Vendor/single/{$entry}",
                    method: HttpMethod::POST,
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
                return PayabliApiResponseVendors::fromJson($json);
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
     * Retrieves a vendor's details, including enrichment status and payment acceptance info when available.
     *
     * Example:
     * ```php
     * $client->vendor->getVendor(
     *     1,
     * );
     * ```
     *
     * @param int $idVendor Vendor ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VendorQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getVendor(int $idVendor, ?array $options = null): ?VendorQueryRecord
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
                    path: "Vendor/{$idVendor}",
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
                return VendorQueryRecord::fromJson($json);
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
     * Updates a vendor's information. Send only the fields you need to update.
     *
     * Example:
     * ```php
     * $client->vendor->editVendor(
     *     1,
     *     new VendorData([
     *         'name1' => "Theodore's Janitorial",
     *     ]),
     * );
     * ```
     *
     * @param int $idVendor Vendor ID.
     * @param VendorData $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponseVendors
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function editVendor(int $idVendor, VendorData $request, ?array $options = null): ?PayabliApiResponseVendors
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
                    path: "Vendor/{$idVendor}",
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
                return PayabliApiResponseVendors::fromJson($json);
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
     * Delete a vendor.
     *
     * Example:
     * ```php
     * $client->vendor->deleteVendor(
     *     1,
     * );
     * ```
     *
     * @param int $idVendor Vendor ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponseVendors
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deleteVendor(int $idVendor, ?array $options = null): ?PayabliApiResponseVendors
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
                    path: "Vendor/{$idVendor}",
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
                return PayabliApiResponseVendors::fromJson($json);
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
     * Triggers AI-powered vendor enrichment for an existing vendor. Runs one or more enrichment stages (invoice scan, web search) based on the `scope` parameter. Can automatically apply extracted payment acceptance info and vendor contact information to the vendor record, or return raw results for manual review. Contact Payabli to enable this feature.
     *
     * Example:
     * ```php
     * $client->vendor->enrichVendor(
     *     '8cfec329267',
     *     new VendorEnrichRequest([
     *         'vendorId' => 456,
     *         'scope' => [
     *             'invoice_scan',
     *         ],
     *         'applyEnrichmentData' => false,
     *         'invoiceFile' => new FileContent([
     *             'fContent' => '<base64-encoded-pdf>',
     *             'filename' => 'invoice-2026-001.pdf',
     *             'ftype' => FileContentFtype::Pdf->value,
     *         ]),
     *         'fallbackMethod' => 'check',
     *     ]),
     * );
     * ```
     *
     * @param string $entry Entrypoint identifier.
     * @param VendorEnrichRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VendorEnrichResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function enrichVendor(string $entry, VendorEnrichRequest $request, ?array $options = null): ?VendorEnrichResponse
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
                    path: "Vendor/enrich/{$entry}",
                    method: HttpMethod::POST,
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
                return VendorEnrichResponse::fromJson($json);
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
     * Schedules an AI outreach call to a vendor to collect their preferred payment method and contact email. This is the third enrichment stage. Calls are scheduled for the next business day at around 9 AM in the vendor's timezone, with retries on no-answer and a fallback payment method applied when retries are exhausted. This feature is opt-in at the org level. Contact your Payabli representative to enable it, provision a phone number, and discuss pricing.
     *
     * Example:
     * ```php
     * $client->vendor->scheduleEnrichmentCall(
     *     '8cfec329267',
     *     new ScheduleEnrichmentCallRequest([
     *         'vendorId' => 456,
     *         'phone' => '5555550200',
     *         'enrichmentId' => 'enrich-3890-a1b2c3d4',
     *         'billId' => 54323,
     *         'fallbackMethod' => 'check',
     *         'maxRetries' => 3,
     *         'timezone' => 'America/New_York',
     *     ]),
     * );
     * ```
     *
     * @param string $entry Entrypoint identifier.
     * @param ScheduleEnrichmentCallRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VendorScheduleCallResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function scheduleEnrichmentCall(string $entry, ScheduleEnrichmentCallRequest $request, ?array $options = null): ?VendorScheduleCallResponse
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
                    path: "Vendor/enrich/schedule_call/{$entry}",
                    method: HttpMethod::POST,
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
                return VendorScheduleCallResponse::fromJson($json);
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
     * Returns the latest AI outreach call activity for a vendor. The response is a composite object with a `state` discriminator (`none`, `scheduled`, `successful`, or `failed`); the block that matches the current state is populated. When the vendor has no call activity, `state` is `none` and the response returns HTTP 200.
     *
     * Example:
     * ```php
     * $client->vendor->getEnrichmentCallStatus(
     *     456,
     * );
     * ```
     *
     * @param int $idVendor ID of the vendor to read call status for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VendorCallStatusResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getEnrichmentCallStatus(int $idVendor, ?array $options = null): ?VendorCallStatusResponse
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
                    path: "Vendor/{$idVendor}/enrichment/call-status",
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
                return VendorCallStatusResponse::fromJson($json);
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
