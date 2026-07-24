<?php

namespace Payabli\PayoutSubscription;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\PayoutSubscription\Requests\RequestPayoutSchedule;
use Payabli\Types\AddPayoutSubscriptionResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\GetPayoutSubscriptionResponse;
use Payabli\PayoutSubscription\Requests\UpdatePayoutSubscriptionBody;
use Payabli\Types\UpdatePayoutSubscriptionResponse;
use Payabli\Types\DeletePayoutSubscriptionResponse;

class PayoutSubscriptionClient
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
     * Creates a payout subscription to automatically send payouts to a vendor on a recurring schedule. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for a step-by-step guide.
     *
     * Example:
     * ```php
     * $client->payoutSubscription->createPayoutSubscription(
     *     new RequestPayoutSchedule([
     *         'entryPoint' => '8cfec329267',
     *         'paymentMethod' => new AuthorizePaymentMethod([
     *             'method' => 'ach',
     *             'achHolder' => 'Herman Coatings',
     *             'achRouting' => '021000021',
     *             'achAccount' => '3453445666',
     *             'achAccountType' => 'checking',
     *         ]),
     *         'paymentDetails' => new PayoutPaymentDetail([
     *             'totalAmount' => 500,
     *             'serviceFee' => 0,
     *             'currency' => 'USD',
     *         ]),
     *         'vendorData' => new RequestOutAuthorizeVendorData([
     *             'vendorId' => 456,
     *         ]),
     *         'billData' => [
     *             new BillPayOutDataRequest([
     *                 'dueDate' => new DateTime('2025-08-15'),
     *                 'invoiceDate' => new DateTime('2025-08-01'),
     *                 'invoiceNumber' => 'INV-2345',
     *                 'netAmount' => '500',
     *             ]),
     *         ],
     *         'scheduleDetails' => new PayoutScheduleDetail([
     *             'startDate' => '09/01/2027',
     *             'endDate' => '09/01/2026',
     *             'frequency' => Frequency::Monthly->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param RequestPayoutSchedule $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddPayoutSubscriptionResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createPayoutSubscription(RequestPayoutSchedule $request, ?array $options = null): ?AddPayoutSubscriptionResponse
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
                    path: "PayoutSubscription",
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
                return AddPayoutSubscriptionResponse::fromJson($json);
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
     * Retrieves a single payout subscription's details. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
     *
     * Example:
     * ```php
     * $client->payoutSubscription->getPayoutSubscription(
     *     42,
     * );
     * ```
     *
     * @param int $id The payout subscription ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetPayoutSubscriptionResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPayoutSubscription(int $id, ?array $options = null): ?GetPayoutSubscriptionResponse
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
                    path: "PayoutSubscription/{$id}",
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
                return GetPayoutSubscriptionResponse::fromJson($json);
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
     * Updates a payout subscription's details. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
     *
     * Example:
     * ```php
     * $client->payoutSubscription->updatePayoutSubscription(
     *     42,
     *     new UpdatePayoutSubscriptionBody([
     *         'setPause' => true,
     *     ]),
     * );
     * ```
     *
     * @param int $id The payout subscription ID.
     * @param UpdatePayoutSubscriptionBody $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdatePayoutSubscriptionResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePayoutSubscription(int $id, UpdatePayoutSubscriptionBody $request = new UpdatePayoutSubscriptionBody(), ?array $options = null): ?UpdatePayoutSubscriptionResponse
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
                    path: "PayoutSubscription/{$id}",
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
                return UpdatePayoutSubscriptionResponse::fromJson($json);
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
     * Deletes a payout subscription and prevents future payouts. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
     *
     * Example:
     * ```php
     * $client->payoutSubscription->deletePayoutSubscription(
     *     42,
     * );
     * ```
     *
     * @param int $id The payout subscription ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DeletePayoutSubscriptionResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deletePayoutSubscription(int $id, ?array $options = null): ?DeletePayoutSubscriptionResponse
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
                    path: "PayoutSubscription/{$id}",
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
                return DeletePayoutSubscriptionResponse::fromJson($json);
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
