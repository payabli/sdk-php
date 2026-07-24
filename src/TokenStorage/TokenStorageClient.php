<?php

namespace Payabli\TokenStorage;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\TokenStorage\Requests\AddMethodRequest;
use Payabli\Types\AddMethodResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\TokenStorage\Requests\GetMethodRequest;
use Payabli\Types\GetMethodResponse;
use Payabli\TokenStorage\Requests\UpdateMethodRequest;
use Payabli\Types\PayabliApiResponsePaymethodDelete;

class TokenStorageClient
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
     * Saves a payment method for reuse. This call exchanges sensitive payment information for a token that can be used to process future transactions. The `ReferenceId` value in the response is the `storedMethodId` to use with transactions.
     *
     * Example:
     * ```php
     * $client->tokenStorage->addMethod(
     *     new AddMethodRequest([
     *         'body' => new RequestTokenStorage([
     *             'customerData' => new PayorDataRequest([
     *                 'customerId' => 4440,
     *             ]),
     *             'entryPoint' => '8cfec329267',
     *             'fallbackAuth' => true,
     *             'fallbackAuthAmount' => 100,
     *             'methodDescription' => 'Primary Visa card',
     *             'paymentMethod' => new TokenizeCard([
     *                 'method' => 'card',
     *                 'cardcvv' => '123',
     *                 'cardexp' => '12/29',
     *                 'cardHolder' => 'John Doe',
     *                 'cardnumber' => '4111111111111111',
     *                 'cardzip' => '12345',
     *             ]),
     *             'source' => 'api',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param AddMethodRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddMethodResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addMethod(AddMethodRequest $request, ?array $options = null): ?AddMethodResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->achValidation != null) {
            $query['achValidation'] = $request->achValidation;
        }
        if ($request->createAnonymous != null) {
            $query['createAnonymous'] = $request->createAnonymous;
        }
        if ($request->forceCustomerCreation != null) {
            $query['forceCustomerCreation'] = $request->forceCustomerCreation;
        }
        if ($request->temporary != null) {
            $query['temporary'] = $request->temporary;
        }
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "TokenStorage/add",
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
                return AddMethodResponse::fromJson($json);
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
     * Retrieves details for a saved payment method.
     *
     * Example:
     * ```php
     * $client->tokenStorage->getMethod(
     *     '32-8877drt00045632-678',
     *     new GetMethodRequest([
     *         'cardExpirationFormat' => 1,
     *         'includeTemporary' => false,
     *     ]),
     * );
     * ```
     *
     * @param string $methodId The saved payment method ID.
     * @param GetMethodRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetMethodResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getMethod(string $methodId, GetMethodRequest $request = new GetMethodRequest(), ?array $options = null): ?GetMethodResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->cardExpirationFormat != null) {
            $query['cardExpirationFormat'] = $request->cardExpirationFormat;
        }
        if ($request->includeTemporary != null) {
            $query['includeTemporary'] = $request->includeTemporary;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "TokenStorage/{$methodId}",
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
                return GetMethodResponse::fromJson($json);
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
     * Updates a saved payment method.
     *
     * Example:
     * ```php
     * $client->tokenStorage->updateMethod(
     *     '32-8877drt00045632-678',
     *     new UpdateMethodRequest([
     *         'body' => new RequestTokenStorage([
     *             'customerData' => new PayorDataRequest([
     *                 'customerId' => 4440,
     *             ]),
     *             'entryPoint' => '8cfec329267',
     *             'fallbackAuth' => true,
     *             'paymentMethod' => new TokenizeCard([
     *                 'method' => 'card',
     *                 'cardcvv' => '123',
     *                 'cardexp' => '12/29',
     *                 'cardHolder' => 'John Doe',
     *                 'cardnumber' => '4111111111111111',
     *                 'cardzip' => '12345',
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $methodId The saved payment method ID.
     * @param UpdateMethodRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymethodDelete
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateMethod(string $methodId, UpdateMethodRequest $request, ?array $options = null): ?PayabliApiResponsePaymethodDelete
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->achValidation != null) {
            $query['achValidation'] = $request->achValidation;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "TokenStorage/{$methodId}",
                    method: HttpMethod::PUT,
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
                return PayabliApiResponsePaymethodDelete::fromJson($json);
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
     * Deletes a saved payment method.
     *
     * Example:
     * ```php
     * $client->tokenStorage->removeMethod(
     *     '32-8877drt00045632-678',
     * );
     * ```
     *
     * @param string $methodId The saved payment method ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymethodDelete
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function removeMethod(string $methodId, ?array $options = null): ?PayabliApiResponsePaymethodDelete
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
                    path: "TokenStorage/{$methodId}",
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
                return PayabliApiResponsePaymethodDelete::fromJson($json);
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
