<?php

namespace Payabli\People;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\People\Requests\ListPeoplePeopleRequest;
use Payabli\Types\ListPeopleEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\People\Requests\CreatePersonRequest;
use Payabli\Types\PersonDetailEnvelope;
use Payabli\People\Requests\UpdatePersonRequest;
use Payabli\Types\PersonUpdatedEnvelope;
use Payabli\People\Requests\SearchPeopleRequest;
use Payabli\Types\PeopleSearchEnvelope;
use Payabli\People\Requests\SearchPeopleUnmaskedRequest;

class PeopleClient
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
     * Lists people with optional filtering and pagination.
     *
     * Example:
     * ```php
     * $client->people->listPeople(
     *     new ListPeoplePeopleRequest([
     *         'limit' => 1,
     *         'page' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListPeoplePeopleRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPeopleEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listPeople(ListPeoplePeopleRequest $request = new ListPeoplePeopleRequest(), ?array $options = null): ?ListPeopleEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->name != null) {
            $query['name'] = $request->name;
        }
        if ($request->email != null) {
            $query['email'] = $request->email;
        }
        if ($request->verificationStatus != null) {
            $query['verificationStatus'] = $request->verificationStatus;
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
                    path: "v2/people",
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
                return ListPeopleEnvelope::fromJson($json);
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
     * Creates a person, an individual associated with a business such as an
     * owner, director, or signer. Include a `businessRelationship` object to
     * link the person to a business on create; the business reference, role
     * (`personType`), and `ownershipPercentage` go inside that object.
     *
     * A person's job `title` and whether they're the signer (`isSigner`) also
     * belong to the business link, so send them inside `businessRelationship`.
     * A top-level `title` returns a `400` with the message
     * `title moved into the businessRelationship object; send them there instead of at the top level.`
     *
     * Example:
     * ```php
     * $client->people->createPerson(
     *     new CreatePersonRequest([
     *         'firstName' => 'Marcus',
     *         'middleName' => 'James',
     *         'lastName' => 'Delgado',
     *         'primaryEmail' => 'marcus.delgado@example.com',
     *         'secondaryEmail' => 'm.delgado@example.net',
     *         'primaryPhoneNumber' => '3055551212',
     *         'secondaryPhoneNumber' => '3055559876',
     *         'dateOfBirth' => '1985-03-14',
     *         'ssn' => '412-55-9021',
     *         'nationality' => 'US',
     *         'driversLicenseNumber' => 'D1234567',
     *         'driversLicenseState' => 'FL',
     *         'externalId' => 'person-001',
     *         'customData' => [
     *             'department' => "finance",
     *         ],
     *         'addresses' => [
     *             new PersonAddressRequest([
     *                 'addressLine1' => '123 Main Street',
     *                 'addressLine2' => 'Suite 400',
     *                 'cityLocality' => 'Miami',
     *                 'stateProvince' => 'FL',
     *                 'postalCode' => '33101',
     *                 'country' => 'US',
     *                 'type' => PersonAddressType::Legal->value,
     *             ]),
     *         ],
     *         'identificationDocuments' => [
     *             new IdentificationDocumentRequest([
     *                 'type' => 'passport',
     *                 'number' => 'X1234567',
     *                 'issuingCountry' => 'US',
     *                 'expirationDate' => '2030-06-30',
     *             ]),
     *         ],
     *         'businessRelationship' => new BusinessRelationshipRequest([
     *             'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *             'personType' => PersonType::Owner->value,
     *             'ownershipPercentage' => 100,
     *             'isPrimaryController' => true,
     *             'isSigner' => true,
     *             'title' => 'CEO',
     *             'primaryEmail' => 'contact@example.com',
     *             'secondaryEmail' => 'contact.alt@example.net',
     *             'primaryPhoneNumber' => '3055551212',
     *             'secondaryPhoneNumber' => '3055559876',
     *             'billingAddress' => new PersonAddressRequest([
     *                 'addressLine1' => '123 Main Street',
     *                 'cityLocality' => 'Miami',
     *                 'stateProvince' => 'FL',
     *                 'postalCode' => '33101',
     *                 'country' => 'US',
     *                 'type' => PersonAddressType::Billing->value,
     *             ]),
     *             'mailingAddress' => new PersonAddressRequest([
     *                 'addressLine1' => '456 Oak Avenue',
     *                 'cityLocality' => 'Miami',
     *                 'stateProvince' => 'FL',
     *                 'postalCode' => '33102',
     *                 'country' => 'US',
     *                 'type' => PersonAddressType::Mailing->value,
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreatePersonRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PersonDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createPerson(CreatePersonRequest $request, ?array $options = null): ?PersonDetailEnvelope
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
                    path: "v2/people",
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
                return PersonDetailEnvelope::fromJson($json);
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
     * Retrieves a person by reference. Sensitive fields such as `ssn` are masked.
     *
     * Example:
     * ```php
     * $client->people->getPerson(
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     * );
     * ```
     *
     * @param string $personReference The person reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PersonDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPerson(string $personReference, ?array $options = null): ?PersonDetailEnvelope
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
                    path: "v2/people/{$personReference}",
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
                return PersonDetailEnvelope::fromJson($json);
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
     * Applies a partial update to a person. Send only the fields you want to change.
     *
     * A person's job title belongs to their business link, not the person. Sending `title` in any form, including `null`, returns a `400` with the message `title moved to the business relationship; update it with PATCH /api/v2/businesses/{businessReference}/people/{personReference}.`
     *
     * Example:
     * ```php
     * $client->people->updatePerson(
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     *     new UpdatePersonRequest([
     *         'primaryPhoneNumber' => '3055550199',
     *     ]),
     * );
     * ```
     *
     * @param string $personReference The person reference.
     * @param UpdatePersonRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PersonUpdatedEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePerson(string $personReference, UpdatePersonRequest $request = new UpdatePersonRequest(), ?array $options = null): ?PersonUpdatedEnvelope
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
                    path: "v2/people/{$personReference}",
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
                return PersonUpdatedEnvelope::fromJson($json);
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
     * Retrieves a person by reference with sensitive fields unmasked.
     *
     * Example:
     * ```php
     * $client->people->getPersonUnmasked(
     *     '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     * );
     * ```
     *
     * @param string $personReference The person reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PersonDetailEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPersonUnmasked(string $personReference, ?array $options = null): ?PersonDetailEnvelope
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
                    path: "v2/people/{$personReference}/unmasked",
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
                return PersonDetailEnvelope::fromJson($json);
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
     * Searches for people by identity attributes during boarding. The search
     * covers every business in your organization, so use it to find a person
     * before you create them again. To read the people already on a
     * paypoint's business, use a standard `GET` instead.
     * Provide at least one of `firstName` or `lastName`. Each result has a
     * `matchScore` showing how closely it matches, and an external identity
     * vendor can enrich the results. Each result's `dateOfBirth` is masked.
     * To get the full value, use the unmasked search.
     *
     * Example:
     * ```php
     * $client->people->searchPeople(
     *     new SearchPeopleRequest([
     *         'entry' => '8cfec329267',
     *         'orgId' => 123,
     *         'body' => [
     *             'firstName' => "Marcus",
     *             'lastName' => "Delgado",
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param SearchPeopleRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PeopleSearchEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function searchPeople(SearchPeopleRequest $request, ?array $options = null): ?PeopleSearchEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        $query['entry'] = $request->entry;
        $query['orgId'] = $request->orgId;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/people/search",
                    method: HttpMethod::POST,
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
                return PeopleSearchEnvelope::fromJson($json);
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
     * Searches for people by identity attributes during boarding, and returns
     * each result's `dateOfBirth` unmasked. The query parameters, request
     * body, and other response fields match the standard people search.
     * Provide at least one of `firstName` or `lastName`.
     *
     * Example:
     * ```php
     * $client->people->searchPeopleUnmasked(
     *     new SearchPeopleUnmaskedRequest([
     *         'entry' => '8cfec329267',
     *         'orgId' => 123,
     *         'body' => [
     *             'firstName' => "Marcus",
     *             'lastName' => "Delgado",
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param SearchPeopleUnmaskedRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PeopleSearchEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function searchPeopleUnmasked(SearchPeopleUnmaskedRequest $request, ?array $options = null): ?PeopleSearchEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        $query['entry'] = $request->entry;
        $query['orgId'] = $request->orgId;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/people/search/unmasked",
                    method: HttpMethod::POST,
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
                return PeopleSearchEnvelope::fromJson($json);
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
