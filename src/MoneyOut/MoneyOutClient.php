<?php

namespace Payabli\MoneyOut;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\MoneyOut\Requests\RequestOutAuthorize;
use Payabli\Types\AuthCapturePayoutResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\CaptureAllOutResponse;
use Payabli\Core\Json\JsonSerializer;
use Payabli\Types\PayabliApiResponse0000;
use Payabli\MoneyOut\Requests\CaptureAllOutRequest;
use Payabli\MoneyOut\Requests\CaptureOutRequest;
use Payabli\Types\BillDetailResponse;
use Payabli\Types\VCardGetResponse;
use Payabli\MoneyOut\Requests\RenewVCardRequest;
use Payabli\Types\RenewVCardResponse;
use Payabli\MoneyOut\Requests\SendVCardLinkRequest;
use Payabli\Types\OperationResult;
use Payabli\Core\Json\JsonDecoder;
use Payabli\Types\AllowedCheckPaymentStatus;
use Payabli\Types\PayabliApiResponse00Responsedatanonobject;
use Payabli\MoneyOut\Requests\ReissueOutRequest;
use Payabli\Types\ReissuePayoutResponse;

class MoneyOutClient
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
     * Authorizes a transaction for payout.
     *
     * If you don't pass `autoCapture` with a value of `true`, authorized transactions aren't flagged for settlement until captured. Use the `referenceId` returned in the response to capture the transaction.
     *
     * When `autoCapture` is `true`, Payabli captures the transaction asynchronously after authorization. The response confirms only that the transaction was authorized; it doesn't confirm that capture succeeded. To confirm capture, listen for the [`payout_transaction_approvedcaptured`](/developers/api-reference/webhooks-overview/payout-transaction-approved-captured) webhook event.
     *
     * If a velocity fraud alert is triggered, the endpoint returns a `202` response with `responseCode` `9051`, and the authorization is held for risk review rather than rejected. If a risk policy blocks the transaction, the endpoint returns a `422` response with `responseCode` `9005`, a terminal rejection.
     *
     * For check payouts, Payabli validates the remit (mailing) address at authorization. If the address fails deliverability validation, the endpoint returns a `422` response and doesn't charge the paypoint. Correct the address and re-authorize. Other payout rails (ACH, RTP, virtual card, wire, and managed payables) aren't affected.
     *
     * Example:
     * ```php
     * $client->moneyOut->authorizeOut(
     *     new RequestOutAuthorize([
     *         'entryPoint' => '8cfec329267',
     *         'orderDescription' => 'Window Painting',
     *         'paymentMethod' => new AuthorizePaymentMethod([
     *             'method' => 'managed',
     *         ]),
     *         'paymentDetails' => new RequestOutAuthorizePaymentDetails([
     *             'totalAmount' => 47,
     *             'unbundled' => false,
     *         ]),
     *         'vendorData' => new RequestOutAuthorizeVendorData([
     *             'vendorNumber' => 'VEN-123',
     *         ]),
     *         'invoiceData' => [
     *             new RequestOutAuthorizeInvoiceData([
     *                 'billId' => 54323,
     *             ]),
     *         ],
     *         'autoCapture' => true,
     *     ]),
     * );
     * ```
     *
     * @param RequestOutAuthorize $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AuthCapturePayoutResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function authorizeOut(RequestOutAuthorize $request, ?array $options = null): ?AuthCapturePayoutResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->allowDuplicatedBills != null) {
            $query['allowDuplicatedBills'] = $request->allowDuplicatedBills;
        }
        if ($request->doNotCreateBills != null) {
            $query['doNotCreateBills'] = $request->doNotCreateBills;
        }
        if ($request->forceVendorCreation != null) {
            $query['forceVendorCreation'] = $request->forceVendorCreation;
        }
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "MoneyOut/authorize",
                    method: HttpMethod::POST,
                    headers: $headers,
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
                return AuthCapturePayoutResponse::fromJson($json);
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
     * Cancels an array of payout transactions.
     *
     * Example:
     * ```php
     * $client->moneyOut->cancelAllOut(
     *     [
     *         '2-29',
     *         '2-28',
     *         '2-27',
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
     * @return ?CaptureAllOutResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function cancelAllOut(array $request, ?array $options = null): ?CaptureAllOutResponse
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
                    path: "MoneyOut/cancelAll",
                    method: HttpMethod::POST,
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
                return CaptureAllOutResponse::fromJson($json);
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
     * Cancel a payout transaction by ID.
     *
     * Example:
     * ```php
     * $client->moneyOut->cancelOutGet(
     *     '129-219',
     * );
     * ```
     *
     * @param string $referenceId The ID for the payout transaction.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponse0000
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function cancelOutGet(string $referenceId, ?array $options = null): ?PayabliApiResponse0000
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
                    path: "MoneyOut/cancel/{$referenceId}",
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
                return PayabliApiResponse0000::fromJson($json);
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
     * Cancel a payout transaction by ID.
     *
     * Example:
     * ```php
     * $client->moneyOut->cancelOutDelete(
     *     '129-219',
     * );
     * ```
     *
     * @param string $referenceId The ID for the payout transaction.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponse0000
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function cancelOutDelete(string $referenceId, ?array $options = null): ?PayabliApiResponse0000
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
                    path: "MoneyOut/cancel/{$referenceId}",
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
                return PayabliApiResponse0000::fromJson($json);
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
     * Captures an array of authorized payout transactions for settlement. The maximum number of transactions that can be captured in a single request is 500.
     *
     * Example:
     * ```php
     * $client->moneyOut->captureAllOut(
     *     new CaptureAllOutRequest([
     *         'body' => [
     *             '2-29',
     *             '2-28',
     *             '2-27',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param CaptureAllOutRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaptureAllOutResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function captureAllOut(CaptureAllOutRequest $request, ?array $options = null): ?CaptureAllOutResponse
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
                    path: "MoneyOut/captureAll",
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
                return CaptureAllOutResponse::fromJson($json);
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
     * Captures a single authorized payout transaction by ID. If the transaction was authorized with `autoCapture` set to `true`, you don't need to call this endpoint to capture the transaction for processing.
     *
     * If a velocity fraud alert is triggered, the endpoint returns a `202` response with `responseCode` `9051`, and the capture is held for risk review rather than rejected. If a risk policy blocks the transaction, the endpoint returns a `422` response with `responseCode` `9005`, a terminal rejection.
     *
     * Example:
     * ```php
     * $client->moneyOut->captureOut(
     *     '129-219',
     *     new CaptureOutRequest([]),
     * );
     * ```
     *
     * @param string $referenceId The ID for the payout transaction.
     * @param CaptureOutRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AuthCapturePayoutResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function captureOut(string $referenceId, CaptureOutRequest $request = new CaptureOutRequest(), ?array $options = null): ?AuthCapturePayoutResponse
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
                    path: "MoneyOut/capture/{$referenceId}",
                    method: HttpMethod::GET,
                    headers: $headers,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return AuthCapturePayoutResponse::fromJson($json);
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
     * Returns details for a processed money out transaction.
     *
     * Example:
     * ```php
     * $client->moneyOut->payoutDetails(
     *     '45-as456777hhhhhhhhhh77777777-324',
     * );
     * ```
     *
     * @param string $transId ReferenceId for the transaction (PaymentId).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BillDetailResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function payoutDetails(string $transId, ?array $options = null): ?BillDetailResponse
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
                    path: "MoneyOut/details/{$transId}",
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
                return BillDetailResponse::fromJson($json);
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
     * Retrieves vCard details for a single card in an entrypoint.
     *
     * Example:
     * ```php
     * $client->moneyOut->vCardGet(
     *     '20230403315245421165',
     * );
     * ```
     *
     * @param string $cardToken ID for a virtual card.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VCardGetResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function vCardGet(string $cardToken, ?array $options = null): ?VCardGetResponse
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
                    path: "MoneyOut/vcard/{$cardToken}",
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
                return VCardGetResponse::fromJson($json);
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
     * Renews an expired or expiring virtual card by extending its expiration date to a future month.
     *
     * The card must be a virtual card that hasn't been fully used. The new expiration date must be in `MM-YYYY` or `MM/YYYY` format and no more than 2 years and 363 days in the future. The card expires on the last day of the month you specify.
     *
     * On success, `referenceId` holds the renewed card's token (the card processor may issue a new token). The response reuses the standard payout result object, so the payment-transaction fields it carries don't apply to renewal and always return `null`.
     *
     * Example:
     * ```php
     * $client->moneyOut->renewVCard(
     *     '20231206142225226104',
     *     new RenewVCardRequest([
     *         'expirationDate' => '12-2027',
     *     ]),
     * );
     * ```
     *
     * @param string $cardToken ID for the virtual card to renew.
     * @param RenewVCardRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RenewVCardResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function renewVCard(string $cardToken, RenewVCardRequest $request, ?array $options = null): ?RenewVCardResponse
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
                    path: "MoneyOutCard/vcard/{$cardToken}/renew",
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
                return RenewVCardResponse::fromJson($json);
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
     * Sends a virtual card link via email to the vendor associated with the `transId`.
     *
     * Example:
     * ```php
     * $client->moneyOut->sendVCardLink(
     *     new SendVCardLinkRequest([
     *         'transId' => '01K33Z6YQZ6GD5QVKZ856MJBSC',
     *     ]),
     * );
     * ```
     *
     * @param SendVCardLinkRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OperationResult
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function sendVCardLink(SendVCardLinkRequest $request, ?array $options = null): ?OperationResult
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
                    path: "vcard/send-card-link",
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
                return OperationResult::fromJson($json);
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
     * Retrieve the image of a check associated with a processed transaction.
     * The check image is returned in the response body as a base64-encoded string.
     * The check image is only available for payouts that have been processed.
     *
     * Example:
     * ```php
     * $client->moneyOut->getCheckImage(
     *     'check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf',
     * );
     * ```
     *
     * Name of the check asset to retrieve. This is returned as `filename` in the `CheckData` object
     * in the response when you make a GET request to `/MoneyOut/details/{transId}`.
     * ```
     *     "CheckData": {
     *       "ftype": "PDF",
     *       "filename": "check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf",
     *       "furl": "",
     *       "fContent": ""
     *   }
     * ```
     *
     * @param string $assetName
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?string
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getCheckImage(string $assetName, ?array $options = null): ?string
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
                    path: "MoneyOut/checkimage/{$assetName}",
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
                return JsonDecoder::decodeString($json);
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
     * Updates the status of a processed check payment transaction. This endpoint handles the status transition, updates related bills, creates audit events, and triggers notifications.
     *
     * The transaction must meet all of the following criteria:
     * - **Status**: Must be in Processing or Processed status.
     * - **Payment method**: Must be a check payment method.
     *
     * ### Allowed status values
     *
     * | Value | Status | Description |
     * |-------|--------|-------------|
     * | `0` | Cancelled/Voided | Cancels the check transaction. Reverts associated bills to their previous state (Approved or Active), creates "Cancelled" events, and sends a `payout_transaction_voidedcancelled` notification if the notification is enabled. |
     * | `5` | Paid | Marks the check transaction as paid. Updates associated bills to "Paid" status, creates "Paid" events, and sends a `payout_transaction_paid` notification if the notification is enabled. |
     *
     * Example:
     * ```php
     * $client->moneyOut->updateCheckPaymentStatus(
     *     'TRANS123456',
     *     AllowedCheckPaymentStatus::Paid->value,
     * );
     * ```
     *
     * @param string $transId The Payabli transaction ID for the check payment.
     * @param value-of<AllowedCheckPaymentStatus> $checkPaymentStatus The new status to apply to the check transaction. To mark a check as `Paid`, send 5. To mark a check as `Cancelled`, send 0.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponse00Responsedatanonobject
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateCheckPaymentStatus(string $transId, string $checkPaymentStatus, ?array $options = null): ?PayabliApiResponse00Responsedatanonobject
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
                    path: "MoneyOut/status/{$transId}/{$checkPaymentStatus}",
                    method: HttpMethod::PATCH,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PayabliApiResponse00Responsedatanonobject::fromJson($json);
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
     * Reissues a payout transaction with a new payment method. This creates a new transaction linked to the original and marks the original transaction as reissued.
     *
     * The original transaction must be in **Processing** or **Processed** status. The payment method in the request body is used directly. The endpoint doesn't fall back to vendor-managed payment methods.
     *
     * The new transaction goes through the standard authorize-and-capture flow automatically. Both the original and new transactions are linked through their event histories for audit purposes.
     *
     * Example:
     * ```php
     * $client->moneyOut->reissueOut(
     *     new ReissueOutRequest([
     *         'transId' => '129-219',
     *         'paymentMethod' => new ReissuePaymentMethod([
     *             'method' => 'ach',
     *             'achHolder' => 'Acme Corp',
     *             'achRouting' => '021000021',
     *             'achAccount' => '9876543210',
     *             'achAccountType' => 'savings',
     *             'achHolderType' => AchHolderType::Business->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param ReissueOutRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ReissuePayoutResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function reissueOut(ReissueOutRequest $request, ?array $options = null): ?ReissuePayoutResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        $query['transId'] = $request->transId;
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "MoneyOut/reissue",
                    method: HttpMethod::POST,
                    headers: $headers,
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
                return ReissuePayoutResponse::fromJson($json);
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
