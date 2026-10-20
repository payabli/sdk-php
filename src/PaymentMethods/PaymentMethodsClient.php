<?php

namespace Payabli\PaymentMethods;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\PaymentMethods\Requests\ListPaymentMethodsPaymentMethodsRequest;
use Payabli\Types\ListPaymentMethodsEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\PaymentMethods\Requests\CreatePaymentMethodsRequest;
use Payabli\Types\PaymentMethodsCreatedEnvelope;
use Payabli\Types\PaymentMethodDetailEnvelope;
use Payabli\Types\PaymentMethodDeactivatedEnvelope;
use Payabli\PaymentMethods\Requests\UpdatePaymentMethodRequest;
use Payabli\Types\PaymentMethodUpdatedEnvelope;

class PaymentMethodsClient
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
     * Lists payment methods with optional filtering and pagination.
     *
     * Example:
     * ```php
     * $client->paymentMethods->listPaymentMethods(
     *     new ListPaymentMethodsPaymentMethodsRequest([
     *         'limit' => 1,
     *         'page' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListPaymentMethodsPaymentMethodsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPaymentMethodsEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listPaymentMethods(ListPaymentMethodsPaymentMethodsRequest $request = new ListPaymentMethodsPaymentMethodsRequest(), ?array $options = null): ?ListPaymentMethodsEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->accountOwner != null) {
            $query['accountOwner'] = $request->accountOwner;
        }
        if ($request->ownerType != null) {
            $query['ownerType'] = $request->ownerType;
        }
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->type != null) {
            $query['type'] = $request->type;
        }
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        if ($request->sortOrder != null) {
            $query['sortOrder'] = $request->sortOrder;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/payment-methods",
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
                return ListPaymentMethodsEnvelope::fromJson($json);
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
     * Creates one or more payment methods for an entity in a single call.
     * Set each payment method's `accountOwner` to the entity it belongs to.
     *
     * Example:
     * ```php
     * $client->paymentMethods->createPaymentMethods(
     *     new CreatePaymentMethodsRequest([
     *         'data' => [
     *             new CreatePaymentMethodRequest([
     *                 'type' => CreatePaymentMethodRequestType::BankAccount->value,
     *                 'accountOwner' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *                 'ownerType' => PaymentMethodOwnerType::Business->value,
     *                 'nickname' => 'Operating account',
     *                 'financialInstitution' => 'Bank of Example',
     *                 'accountType' => 'checking',
     *                 'accountNumber' => '123456789',
     *                 'routingNumber' => '021000021',
     *                 'usage' => [
     *                     PaymentMethodUsage::Deposits->value,
     *                     PaymentMethodUsage::Billing->value,
     *                 ],
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param CreatePaymentMethodsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodsCreatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createPaymentMethods(CreatePaymentMethodsRequest $request, ?array $options = null): ?PaymentMethodsCreatedEnvelope
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
                    path: "v2/payment-methods",
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
                return PaymentMethodsCreatedEnvelope::fromJson($json);
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
     * Retrieves a payment method by reference. Sensitive fields such as the account and routing numbers are masked.
     *
     * Example:
     * ```php
     * $client->paymentMethods->getPaymentMethod(
     *     '019ff142-454b-7721-96a3-c8628b9d568f',
     * );
     * ```
     *
     * @param string $paymentMethodReference The payment method reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPaymentMethod(string $paymentMethodReference, ?array $options = null): ?PaymentMethodDetailEnvelope
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
                    path: "v2/payment-methods/{$paymentMethodReference}",
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
                return PaymentMethodDetailEnvelope::fromJson($json);
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
     * Deactivates a payment method. This is a soft delete: the payment
     * method moves to `INACTIVE` and the record is kept.
     *
     * Example:
     * ```php
     * $client->paymentMethods->deactivatePaymentMethod(
     *     '019ff142-454b-7721-96a3-c8628b9d568f',
     * );
     * ```
     *
     * @param string $paymentMethodReference The payment method reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDeactivatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deactivatePaymentMethod(string $paymentMethodReference, ?array $options = null): ?PaymentMethodDeactivatedEnvelope
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
                    path: "v2/payment-methods/{$paymentMethodReference}",
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
                return PaymentMethodDeactivatedEnvelope::fromJson($json);
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
     * Applies a partial update to a payment method. Send only the fields you
     * want to change. Only payment methods in `PENDING` status can be updated.
     * Once a payment method is active, change it through the bank account
     * change process instead.
     *
     * Example:
     * ```php
     * $client->paymentMethods->updatePaymentMethod(
     *     '019ff142-454b-7721-96a3-c8628b9d568f',
     *     new UpdatePaymentMethodRequest([
     *         'nickname' => 'Primary operating account',
     *         'usage' => [
     *             PaymentMethodUsage::Deposits->value,
     *             PaymentMethodUsage::Billing->value,
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $paymentMethodReference The payment method reference.
     * @param UpdatePaymentMethodRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodUpdatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePaymentMethod(string $paymentMethodReference, UpdatePaymentMethodRequest $request = new UpdatePaymentMethodRequest(), ?array $options = null): ?PaymentMethodUpdatedEnvelope
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
                    path: "v2/payment-methods/{$paymentMethodReference}",
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
                return PaymentMethodUpdatedEnvelope::fromJson($json);
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
