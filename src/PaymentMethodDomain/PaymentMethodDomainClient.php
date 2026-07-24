<?php

namespace Payabli\PaymentMethodDomain;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\PaymentMethodDomain\Requests\AddPaymentMethodDomainRequest;
use Payabli\Types\AddPaymentMethodDomainApiResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\PaymentMethodDomainGeneralResponse;
use Payabli\Types\PaymentMethodDomainApiResponse;
use Payabli\Types\DeletePaymentMethodDomainResponse;
use Payabli\PaymentMethodDomain\Requests\UpdatePaymentMethodDomainRequest;
use Payabli\PaymentMethodDomain\Requests\ListPaymentMethodDomainsRequest;
use Payabli\Types\ListPaymentMethodDomainsResponse;

class PaymentMethodDomainClient
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
     * Add a payment method domain to an organization or paypoint.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->addPaymentMethodDomain(
     *     new AddPaymentMethodDomainRequest([
     *         'applePay' => new AddPaymentMethodDomainRequestApplePay([
     *             'isEnabled' => true,
     *         ]),
     *         'googlePay' => new AddPaymentMethodDomainRequestGooglePay([
     *             'isEnabled' => true,
     *         ]),
     *         'domainName' => 'checkout.example.com',
     *         'entityId' => 109,
     *         'entityType' => 'paypoint',
     *     ]),
     * );
     * ```
     *
     * @param AddPaymentMethodDomainRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddPaymentMethodDomainApiResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addPaymentMethodDomain(AddPaymentMethodDomainRequest $request = new AddPaymentMethodDomainRequest(), ?array $options = null): ?AddPaymentMethodDomainApiResponse
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
                    path: "PaymentMethodDomain",
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
                return AddPaymentMethodDomainApiResponse::fromJson($json);
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
     * Cascades a payment method domain to all child entities. All paypoints and suborganization under this parent will inherit this domain and its settings.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->cascadePaymentMethodDomain(
     *     'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
     * );
     * ```
     *
     * @param string $domainId The payment method domain's ID in Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDomainGeneralResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function cascadePaymentMethodDomain(string $domainId, ?array $options = null): ?PaymentMethodDomainGeneralResponse
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
                    path: "PaymentMethodDomain/{$domainId}/cascade",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PaymentMethodDomainGeneralResponse::fromJson($json);
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
     * Get the details for a payment method domain.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->getPaymentMethodDomain(
     *     'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
     * );
     * ```
     *
     * @param string $domainId The payment method domain's ID in Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDomainApiResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPaymentMethodDomain(string $domainId, ?array $options = null): ?PaymentMethodDomainApiResponse
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
                    path: "PaymentMethodDomain/{$domainId}",
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
                return PaymentMethodDomainApiResponse::fromJson($json);
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
     * Delete a payment method domain. You can't delete an inherited domain, you must delete a domain at the organization level.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->deletePaymentMethodDomain(
     *     'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
     * );
     * ```
     *
     * @param string $domainId The payment method domain's ID in Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DeletePaymentMethodDomainResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deletePaymentMethodDomain(string $domainId, ?array $options = null): ?DeletePaymentMethodDomainResponse
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
                    path: "PaymentMethodDomain/{$domainId}",
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
                return DeletePaymentMethodDomainResponse::fromJson($json);
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
     * Update a payment method domain's configuration values.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->updatePaymentMethodDomain(
     *     'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
     *     new UpdatePaymentMethodDomainRequest([
     *         'applePay' => new UpdatePaymentMethodDomainRequestWallet([
     *             'isEnabled' => false,
     *         ]),
     *         'googlePay' => new UpdatePaymentMethodDomainRequestWallet([
     *             'isEnabled' => false,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $domainId The payment method domain's ID in Payabli.
     * @param UpdatePaymentMethodDomainRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDomainGeneralResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePaymentMethodDomain(string $domainId, UpdatePaymentMethodDomainRequest $request = new UpdatePaymentMethodDomainRequest(), ?array $options = null): ?PaymentMethodDomainGeneralResponse
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
                    path: "PaymentMethodDomain/{$domainId}",
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
                return PaymentMethodDomainGeneralResponse::fromJson($json);
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
     * Get a list of payment method domains that belong to a PSP, organization, or paypoint.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->listPaymentMethodDomains(
     *     new ListPaymentMethodDomainsRequest([
     *         'entityId' => 1147,
     *         'entityType' => 'paypoint',
     *     ]),
     * );
     * ```
     *
     * @param ListPaymentMethodDomainsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPaymentMethodDomainsResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listPaymentMethodDomains(ListPaymentMethodDomainsRequest $request = new ListPaymentMethodDomainsRequest(), ?array $options = null): ?ListPaymentMethodDomainsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->entityId != null) {
            $query['entityId'] = $request->entityId;
        }
        if ($request->entityType != null) {
            $query['entityType'] = $request->entityType;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentMethodDomain/list",
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
                return ListPaymentMethodDomainsResponse::fromJson($json);
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
     * Verify a new payment method domain. If verification is successful, Apple Pay is automatically activated for the domain.
     *
     * Example:
     * ```php
     * $client->paymentMethodDomain->verifyPaymentMethodDomain(
     *     'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
     * );
     * ```
     *
     * @param string $domainId The payment method domain's ID in Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PaymentMethodDomainGeneralResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function verifyPaymentMethodDomain(string $domainId, ?array $options = null): ?PaymentMethodDomainGeneralResponse
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
                    path: "PaymentMethodDomain/{$domainId}/verify",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PaymentMethodDomainGeneralResponse::fromJson($json);
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
