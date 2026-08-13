<?php

namespace Payabli\Organization;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Organization\Requests\AddOrganizationRequest;
use Payabli\Types\AddOrganizationResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Organization\Requests\OrganizationData;
use Payabli\Types\EditOrganizationResponse;
use Payabli\Types\DeleteOrganizationResponse;
use Payabli\Types\OrganizationQueryRecord;
use Payabli\Types\SettingsQueryRecord;

class OrganizationClient
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
     * Creates an organization under a parent organization. This is also referred to as a suborganization.
     *
     * Example:
     * ```php
     * $client->organization->addOrganization(
     *     new AddOrganizationRequest([
     *         'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
     *         'billingInfo' => new Instrument([
     *             'achAccount' => '123123123',
     *             'achRouting' => '123123123',
     *             'billingAddress' => '123 Walnut Street',
     *             'billingCity' => 'Johnson City',
     *             'billingCountry' => 'US',
     *             'billingState' => 'TN',
     *             'billingZip' => '37615',
     *         ]),
     *         'contacts' => [
     *             new Contacts([
     *                 'contactEmail' => 'herman@hermanscoatings.com',
     *                 'contactName' => 'Herman Martinez',
     *                 'contactPhone' => '3055550000',
     *                 'contactTitle' => 'Owner',
     *             ]),
     *         ],
     *         'hasBilling' => true,
     *         'hasResidual' => true,
     *         'orgAddress' => '123 Walnut Street',
     *         'orgCity' => 'Johnson City',
     *         'orgCountry' => 'US',
     *         'orgEntryName' => 'pilgrim-planner',
     *         'orgId' => '123',
     *         'orgLogo' => new FileContent([
     *             'fContent' => 'TXkgdGVzdCBmaWxlHJ==...',
     *             'filename' => 'my-doc.pdf',
     *             'ftype' => FileContentFtype::Pdf->value,
     *             'furl' => 'https://mysite.com/my-doc.pdf',
     *         ]),
     *         'orgName' => 'Pilgrim Planner',
     *         'orgParentId' => 236,
     *         'orgState' => 'TN',
     *         'orgTimezone' => -5,
     *         'orgType' => 0,
     *         'orgWebsite' => 'www.pilgrimageplanner.com',
     *         'orgZip' => '37615',
     *         'replyToEmail' => 'email@example.com',
     *     ]),
     * );
     * ```
     *
     * @param AddOrganizationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddOrganizationResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addOrganization(AddOrganizationRequest $request, ?array $options = null): ?AddOrganizationResponse
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
                    path: "Organization",
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
                return AddOrganizationResponse::fromJson($json);
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
     * Updates an organization's details by ID.
     *
     * Example:
     * ```php
     * $client->organization->editOrganization(
     *     123,
     *     new OrganizationData([
     *         'contacts' => [
     *             new Contacts([
     *                 'contactEmail' => 'herman@hermanscoatings.com',
     *                 'contactName' => 'Herman Martinez',
     *                 'contactPhone' => '3055550000',
     *                 'contactTitle' => 'Owner',
     *             ]),
     *         ],
     *         'orgAddress' => '123 Walnut Street',
     *         'orgCity' => 'Johnson City',
     *         'orgCountry' => 'US',
     *         'orgEntryName' => 'pilgrim-planner',
     *         'orgId' => '123',
     *         'orgName' => 'Pilgrim Planner',
     *         'orgState' => 'TN',
     *         'orgTimezone' => -5,
     *         'orgType' => 0,
     *         'orgWebsite' => 'www.pilgrimageplanner.com',
     *         'orgZip' => '37615',
     *     ]),
     * );
     * ```
     *
     * @param int $orgIdPathParam The numeric identifier for organization, assigned by Payabli.
     * @param OrganizationData $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?EditOrganizationResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function editOrganization(int $orgIdPathParam, OrganizationData $request = new OrganizationData(), ?array $options = null): ?EditOrganizationResponse
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
                    path: "Organization/{$orgIdPathParam}",
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
                return EditOrganizationResponse::fromJson($json);
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
     * Delete an organization by ID.
     *
     * Example:
     * ```php
     * $client->organization->deleteOrganization(
     *     123,
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DeleteOrganizationResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deleteOrganization(int $orgId, ?array $options = null): ?DeleteOrganizationResponse
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
                    path: "Organization/{$orgId}",
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
                return DeleteOrganizationResponse::fromJson($json);
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
     * Gets an organization's basic information by entry name (entrypoint identifier).
     *
     * Example:
     * ```php
     * $client->organization->getBasicOrganization(
     *     '8cfec329267',
     * );
     * ```
     *
     * @param string $entry The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBasicOrganization(string $entry, ?array $options = null): ?OrganizationQueryRecord
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
                    path: "Organization/basic/{$entry}",
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
                return OrganizationQueryRecord::fromJson($json);
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
     * Gets an organization's basic details by org ID.
     *
     * Example:
     * ```php
     * $client->organization->getBasicOrganizationById(
     *     123,
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getBasicOrganizationById(int $orgId, ?array $options = null): ?OrganizationQueryRecord
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
                    path: "Organization/basicById/{$orgId}",
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
                return OrganizationQueryRecord::fromJson($json);
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
     * Retrieves details for an organization by ID.
     *
     * Example:
     * ```php
     * $client->organization->getOrganization(
     *     123,
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getOrganization(int $orgId, ?array $options = null): ?OrganizationQueryRecord
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
                    path: "Organization/read/{$orgId}",
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
                return OrganizationQueryRecord::fromJson($json);
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
     * Retrieves an organization's settings.
     *
     * Example:
     * ```php
     * $client->organization->getSettingsOrganization(
     *     123,
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SettingsQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getSettingsOrganization(int $orgId, ?array $options = null): ?SettingsQueryRecord
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
                    path: "Organization/settings/{$orgId}",
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
                return SettingsQueryRecord::fromJson($json);
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
