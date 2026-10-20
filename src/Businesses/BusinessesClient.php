<?php

namespace Payabli\Businesses;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Businesses\Requests\ListBusinessesBusinessesRequest;
use Payabli\Types\ListBusinessesEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\CreateBusinessRequest;
use Payabli\Types\BusinessCreatedEnvelope;
use Payabli\Types\BusinessDetailEnvelope;
use Payabli\Businesses\Requests\DeactivateBusinessRequest;
use Payabli\Types\BusinessDeactivatedEnvelope;
use Payabli\Businesses\Requests\UpdateBusinessRequest;
use Payabli\Types\BusinessUpdatedEnvelope;
use Payabli\Types\BusinessAddressListEnvelope;
use Payabli\Businesses\Requests\CreateBusinessAddressRequest;
use Payabli\Types\BusinessAddressEnvelope;
use Payabli\Types\BusinessAddressDeletedEnvelope;
use Payabli\Businesses\Requests\UpdateBusinessAddressRequest;
use Payabli\Types\BusinessPersonListEnvelope;
use Payabli\Businesses\Requests\LinkBusinessPersonRequest;
use Payabli\Types\BusinessPersonEnvelope;
use Payabli\Businesses\Requests\UpdateBusinessPersonRequest;

class BusinessesClient
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
     * Lists businesses with optional filtering and pagination.
     *
     * Example:
     * ```php
     * $client->businesses->listBusinesses(
     *     new ListBusinessesBusinessesRequest([
     *         'limit' => 1,
     *         'page' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListBusinessesBusinessesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListBusinessesEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBusinesses(ListBusinessesBusinessesRequest $request = new ListBusinessesBusinessesRequest(), ?array $options = null): ?ListBusinessesEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->name != null) {
            $query['name'] = $request->name;
        }
        if ($request->merchantCatCode != null) {
            $query['merchantCatCode'] = $request->merchantCatCode;
        }
        if ($request->legalStructure != null) {
            $query['legalStructure'] = $request->legalStructure;
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
                    path: "v2/businesses",
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
                return ListBusinessesEnvelope::fromJson($json);
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
     * Creates a business, the legal entity behind a paypoint. New businesses
     * start in `Draft`. Set `parentReference` to the organization
     * the business belongs to, or omit it to use the organization your
     * credential belongs to.
     *
     * Example:
     * ```php
     * $client->businesses->createBusiness(
     *     new CreateBusinessRequest([
     *         'externalId' => 'rg-001',
     *         'legalName' => 'Rose Gardens LLC',
     *         'legalStructure' => CreateBusinessRequestLegalStructure::Llc->value,
     *         'website' => 'https://example.com',
     *         'merchantCatCode' => '5814',
     *         'phone' => [
     *             '3055551212',
     *         ],
     *         'emails' => [
     *             'ops@example.com',
     *         ],
     *         'paymentMethods' => [
     *             new BusinessPaymentMethod([
     *                 'type' => 'bank_account',
     *                 'name' => 'Operating account',
     *                 'financialInstitution' => 'Bank of Example',
     *                 'ownerType' => 'business',
     *                 'accountType' => 'checking',
     *                 'accountNumber' => '123456789',
     *                 'routingNumber' => '021000021',
     *                 'usage' => [
     *                     'deposits',
     *                     'billing',
     *                 ],
     *                 'isDefault' => true,
     *             ]),
     *             new BusinessPaymentMethod([
     *                 'type' => 'bank_account',
     *                 'name' => 'Payout account',
     *                 'financialInstitution' => 'Bank of Example',
     *                 'ownerType' => 'business',
     *                 'accountType' => 'checking',
     *                 'accountNumber' => '987654321',
     *                 'routingNumber' => '021000021',
     *                 'usage' => [
     *                     'payOutFunding',
     *                 ],
     *                 'isDefault' => false,
     *             ]),
     *         ],
     *         'taxReference' => '477498993',
     *         'parentReference' => '8cfec329267',
     *     ]),
     * );
     * ```
     *
     * @param CreateBusinessRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessCreatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createBusiness(CreateBusinessRequest $request, ?array $options = null): ?BusinessCreatedEnvelope
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
                    path: "v2/businesses",
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
                return BusinessCreatedEnvelope::fromJson($json);
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
     * Retrieves a business by reference. Sensitive fields such as `taxReference` are masked.
     *
     * Example:
     * ```php
     * $client->businesses->getBusiness(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBusiness(string $businessReference, ?array $options = null): ?BusinessDetailEnvelope
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
                    path: "v2/businesses/{$businessReference}",
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
                return BusinessDetailEnvelope::fromJson($json);
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
     * Deactivates a business. This is a soft delete: the business moves to
     * `Deactivated` and the record is kept.
     *
     * Example:
     * ```php
     * $client->businesses->deactivateBusiness(
     *     '019fed33-615d-77b6-afaa-46e7ac9bf36e',
     *     new DeactivateBusinessRequest([
     *         'reason' => 'Duplicate record',
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param DeactivateBusinessRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessDeactivatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deactivateBusiness(string $businessReference, DeactivateBusinessRequest $request = new DeactivateBusinessRequest(), ?array $options = null): ?BusinessDeactivatedEnvelope
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
                    path: "v2/businesses/{$businessReference}",
                    method: HttpMethod::DELETE,
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
                return BusinessDeactivatedEnvelope::fromJson($json);
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
     * Applies a partial update to a business. Send only the fields you want to change.
     *
     * Example:
     * ```php
     * $client->businesses->updateBusiness(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     new UpdateBusinessRequest([
     *         'website' => 'https://example.org',
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param UpdateBusinessRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessUpdatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateBusiness(string $businessReference, UpdateBusinessRequest $request = new UpdateBusinessRequest(), ?array $options = null): ?BusinessUpdatedEnvelope
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
                    path: "v2/businesses/{$businessReference}",
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
                return BusinessUpdatedEnvelope::fromJson($json);
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
     * Retrieves a business by reference with sensitive fields unmasked.
     *
     * Example:
     * ```php
     * $client->businesses->getBusinessUnmasked(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBusinessUnmasked(string $businessReference, ?array $options = null): ?BusinessDetailEnvelope
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
                    path: "v2/businesses/{$businessReference}/unmasked",
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
                return BusinessDetailEnvelope::fromJson($json);
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
     * Lists the addresses on a business. Each address is identified by its `businessAddressReference`.
     *
     * Example:
     * ```php
     * $client->businesses->listBusinessAddresses(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessAddressListEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBusinessAddresses(string $businessReference, ?array $options = null): ?BusinessAddressListEnvelope
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
                    path: "v2/businesses/{$businessReference}/addresses",
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
                return BusinessAddressListEnvelope::fromJson($json);
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
     * Adds an address to a business. Returns the new address and its `businessAddressReference`.
     *
     * Example:
     * ```php
     * $client->businesses->createBusinessAddress(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     new CreateBusinessAddressRequest([
     *         'type' => AddressType::Mailing->value,
     *         'location' => BusinessAddressLocation::Warehouse->value,
     *         'addressLine1' => '202 Warehouse Ln',
     *         'cityLocality' => 'Austin',
     *         'stateProvince' => 'TX',
     *         'postalCode' => '73302',
     *         'country' => 'US',
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param CreateBusinessAddressRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessAddressEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createBusinessAddress(string $businessReference, CreateBusinessAddressRequest $request, ?array $options = null): ?BusinessAddressEnvelope
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
                    path: "v2/businesses/{$businessReference}/addresses",
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
                return BusinessAddressEnvelope::fromJson($json);
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
     * Retrieves a single business address by its `businessAddressReference`.
     *
     * Example:
     * ```php
     * $client->businesses->getBusinessAddress(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '019fed1a-84a6-7043-a6c0-e8aa2d4bec36',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $businessAddressReference The business address reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessAddressEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBusinessAddress(string $businessReference, string $businessAddressReference, ?array $options = null): ?BusinessAddressEnvelope
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
                    path: "v2/businesses/{$businessReference}/addresses/{$businessAddressReference}",
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
                return BusinessAddressEnvelope::fromJson($json);
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
     * Removes an address from a business.
     *
     * Example:
     * ```php
     * $client->businesses->deleteBusinessAddress(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '019fed1a-67d6-768a-b4cc-29d4299e21d9',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $businessAddressReference The business address reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessAddressDeletedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deleteBusinessAddress(string $businessReference, string $businessAddressReference, ?array $options = null): ?BusinessAddressDeletedEnvelope
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
                    path: "v2/businesses/{$businessReference}/addresses/{$businessAddressReference}",
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
                return BusinessAddressDeletedEnvelope::fromJson($json);
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
     * Applies a partial update to a business address. Send only the fields you want to change; omitted fields are kept.
     *
     * Example:
     * ```php
     * $client->businesses->updateBusinessAddress(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '019fed1a-67d6-768a-b4cc-29d4299e21d9',
     *     new UpdateBusinessAddressRequest([
     *         'type' => AddressType::Billing->value,
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $businessAddressReference The business address reference.
     * @param UpdateBusinessAddressRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessAddressEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateBusinessAddress(string $businessReference, string $businessAddressReference, UpdateBusinessAddressRequest $request = new UpdateBusinessAddressRequest(), ?array $options = null): ?BusinessAddressEnvelope
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
                    path: "v2/businesses/{$businessReference}/addresses/{$businessAddressReference}",
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
                return BusinessAddressEnvelope::fromJson($json);
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
     * Lists the people linked to a business, each with the relationship's role, ownership, and relationship-scoped contact details.
     *
     * Example:
     * ```php
     * $client->businesses->listBusinessPeople(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessPersonListEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBusinessPeople(string $businessReference, ?array $options = null): ?BusinessPersonListEnvelope
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
                    path: "v2/businesses/{$businessReference}/people",
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
                return BusinessPersonListEnvelope::fromJson($json);
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
     * Links an existing person to a business, setting the relationship's role, ownership, primary-controller flag, contact fields, and addresses.
     *
     * Example:
     * ```php
     * $client->businesses->linkBusinessPerson(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     new LinkBusinessPersonRequest([
     *         'personReference' => '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     *         'personType' => PersonType::Owner->value,
     *         'ownershipPercentage' => 100,
     *         'isPrimaryController' => true,
     *         'isSigner' => true,
     *         'title' => 'CEO',
     *         'primaryEmail' => 'contact@example.com',
     *         'secondaryEmail' => 'contact.alt@example.net',
     *         'primaryPhoneNumber' => '3055551212',
     *         'secondaryPhoneNumber' => '3055559876',
     *         'billingAddress' => new PersonAddressRequest([
     *             'addressLine1' => '123 Main Street',
     *             'cityLocality' => 'Miami',
     *             'stateProvince' => 'FL',
     *             'postalCode' => '33101',
     *             'country' => 'US',
     *             'type' => PersonAddressType::Billing->value,
     *         ]),
     *         'mailingAddress' => new PersonAddressRequest([
     *             'addressLine1' => '456 Oak Avenue',
     *             'cityLocality' => 'Miami',
     *             'stateProvince' => 'FL',
     *             'postalCode' => '33102',
     *             'country' => 'US',
     *             'type' => PersonAddressType::Mailing->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param LinkBusinessPersonRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessPersonEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function linkBusinessPerson(string $businessReference, LinkBusinessPersonRequest $request, ?array $options = null): ?BusinessPersonEnvelope
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
                    path: "v2/businesses/{$businessReference}/people",
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
                return BusinessPersonEnvelope::fromJson($json);
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
     * Retrieves a single business-person link by the person's reference.
     *
     * Example:
     * ```php
     * $client->businesses->getBusinessPerson(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $personReference The person reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessPersonEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBusinessPerson(string $businessReference, string $personReference, ?array $options = null): ?BusinessPersonEnvelope
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
                    path: "v2/businesses/{$businessReference}/people/{$personReference}",
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
                return BusinessPersonEnvelope::fromJson($json);
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
     * Removes the link between a person and a business. The person record itself isn't deleted.
     *
     * Example:
     * ```php
     * $client->businesses->unlinkBusinessPerson(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $personReference The person reference.
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
    public function unlinkBusinessPerson(string $businessReference, string $personReference, ?array $options = null): void
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
                    path: "v2/businesses/{$businessReference}/people/{$personReference}",
                    method: HttpMethod::DELETE,
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

    /**
     * Applies a partial update to a business-person link. Send only the fields you want to change; omitted fields are kept.
     *
     * Example:
     * ```php
     * $client->businesses->updateBusinessPerson(
     *     '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     *     new UpdateBusinessPersonRequest([
     *         'isPrimaryController' => true,
     *         'primaryEmail' => 'updated.contact@example.com',
     *     ]),
     * );
     * ```
     *
     * @param string $businessReference The business reference (`businessUuid`).
     * @param string $personReference The person reference.
     * @param UpdateBusinessPersonRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BusinessPersonEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateBusinessPerson(string $businessReference, string $personReference, UpdateBusinessPersonRequest $request = new UpdateBusinessPersonRequest(), ?array $options = null): ?BusinessPersonEnvelope
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
                    path: "v2/businesses/{$businessReference}/people/{$personReference}",
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
                return BusinessPersonEnvelope::fromJson($json);
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
