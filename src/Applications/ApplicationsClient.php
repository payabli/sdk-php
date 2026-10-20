<?php

namespace Payabli\Applications;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Applications\Requests\ListApplicationsApplicationsRequest;
use Payabli\Types\ListApplicationsEnvelope;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Applications\Requests\CreateApplicationRequest;
use Payabli\Types\ApplicationEnvelope;
use Payabli\Applications\Requests\UpdateApplicationRequest;
use Payabli\Types\ValidationResultEnvelope;
use Payabli\Applications\Requests\SubmitApplicationRequest;
use Payabli\Types\TransitionResultEnvelope;
use Payabli\Applications\Requests\WithdrawApplicationRequest;
use Payabli\Types\StatusHistoryEnvelope;
use Payabli\Types\EnablementEnvelope;
use Payabli\Types\DocumentRequirementListEnvelope;
use Payabli\Types\ApplicationDocumentListEnvelope;
use Payabli\Applications\Requests\UploadApplicationDocumentRequest;
use Payabli\Types\ApplicationDocumentEnvelope;
use Payabli\Core\Multipart\MultipartFormData;
use Payabli\Core\Multipart\MultipartApiRequest;

class ApplicationsClient
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
     * Lists boarding applications with pagination.
     *
     * Example:
     * ```php
     * $client->applications->listApplications(
     *     new ListApplicationsApplicationsRequest([]),
     * );
     * ```
     *
     * @param ListApplicationsApplicationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListApplicationsEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listApplications(ListApplicationsApplicationsRequest $request = new ListApplicationsApplicationsRequest(), ?array $options = null): ?ListApplicationsEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/requests",
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
                return ListApplicationsEnvelope::fromJson($json);
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
     * Creates a boarding application for a business. The business must
     * already have a paypoint. New applications start in `draft`.
     *
     * Example:
     * ```php
     * $client->applications->createApplication(
     *     new CreateApplicationRequest([
     *         'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
     *         'externalId' => 'APP-2025-0417',
     *         'tags' => [
     *             'priority',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param CreateApplicationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createApplication(CreateApplicationRequest $request, ?array $options = null): ?ApplicationEnvelope
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
                    path: "v2/requests",
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
                return ApplicationEnvelope::fromJson($json);
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
     * Retrieves a boarding application by reference.
     *
     * Example:
     * ```php
     * $client->applications->getApplication(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplication(string $requestsReference, ?array $options = null): ?ApplicationEnvelope
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
                    path: "v2/requests/{$requestsReference}",
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
                return ApplicationEnvelope::fromJson($json);
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
     * Applies a partial update to a boarding application. Send only the fields you want to change.
     *
     * Example:
     * ```php
     * $client->applications->updateApplication(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     *     new UpdateApplicationRequest([
     *         'externalId' => 'APP-2025-0417-REV2',
     *         'tags' => [
     *             'priority',
     *             'expedited',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param UpdateApplicationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateApplication(string $requestsReference, UpdateApplicationRequest $request = new UpdateApplicationRequest(), ?array $options = null): ?ApplicationEnvelope
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
                    path: "v2/requests/{$requestsReference}",
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
                return ApplicationEnvelope::fromJson($json);
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
     * Checks whether the records linked to an application (the business, its people, and its payment methods) include everything the application's requested services need. The response lists any missing or invalid fields by section. Validation doesn't change the application, and it doesn't return a validation token. The request has no body.
     *
     * One owner on the application must be the signer, flagged with `isSigner` on their business link. If no one is flagged, the `people` section returns a `missingFields` entry with `field` set to `people.isSigner`, `label` set to `Signer`, and `reason` set to `required — choose the person who signs the application`. The signer rule isn't reported when the application has no people.
     *
     * The `people` section also checks ownership. At least one person must be the primary controller, flagged with `isPrimaryController`. If no one is, the entry has `field` set to `people.isPrimaryController`, `label` set to `Primary Controller`, and `reason` set to `required — at least one principal must be designated`. Unless the business's `legalStructure` is `government` or `non-profit`, at least one owner must have an `ownershipPercentage` of 25 or more. If no one does, the entry has `field` set to `people.ownershipPercentage`, `label` set to `Qualifying Owner`, and `reason` set to `at least one principal must have an ownership stake of 25% or more`.
     *
     * Validation also reports required documents that have nothing uploaded. See [List application document requirements](/developers/api-reference/applications/list-application-document-requirements). The bank statement requirement appears in the `business` section, with `field` set to `documents.bankStatement`. A person document appears in the `people` section, with `field` set to `people.{personReference}.` followed by the requirement's `fieldPath`, such as `people.01a0014d-ce1a-7110-9bac-c4c59647a88d.person.documents.w9`. Submit doesn't enforce document requirements.
     *
     * Example:
     * ```php
     * $client->applications->validateApplication(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ValidationResultEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function validateApplication(string $requestsReference, ?array $options = null): ?ValidationResultEnvelope
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
                    path: "v2/requests/{$requestsReference}/validate",
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
                return ValidationResultEnvelope::fromJson($json);
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
     * Submits a draft application for review. Your integration (the applicant) calls this after the business, its people, payment methods, and services are in place. Verification then runs automatically.
     *
     * The application must have a signer: an owner flagged with `isSigner` on their business link, or one you name in `signer.personReference`. Payabli records the signer's identity from their person record and business link, so update those before you submit. The `signer` object carries the signature details.
     *
     * If the application has no signer, the request fails with `422` and the error `SIGNER_REQUIRED`. If `signer.personReference` names a person who isn't an owner, the request fails with `422` and the error `SIGNER_NOT_OWNER`. If the application isn't a draft, the request fails with `409` and the error `BIZ_004`, before any signer check. If `signer.reportedSignerIp` isn't a single valid IPv4 or IPv6 address, the request fails with `400` and the error `VALIDATION_ERROR`, and the application isn't submitted.
     *
     * Submit doesn't check every rule that [validate](/developers/api-reference/applications/validate-an-application) reports, such as the primary controller and ownership rules. Validate the application and resolve its missing fields before you submit.
     *
     * Example:
     * ```php
     * $client->applications->submitApplication(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     *     new SubmitApplicationRequest([
     *         'signer' => new SubmitSigner([
     *             'personReference' => '01a0014d-ce1a-7110-9bac-c4c59647a88d',
     *             'signature' => 'Marcus J Delgado',
     *             'signatureType' => SignatureType::Type->value,
     *             'acceptance' => true,
     *             'pciAttestation' => true,
     *             'reportedSignerIp' => '203.0.113.7',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param SubmitApplicationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TransitionResultEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function submitApplication(string $requestsReference, SubmitApplicationRequest $request, ?array $options = null): ?TransitionResultEnvelope
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
                    path: "v2/requests/{$requestsReference}/submit",
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
                return TransitionResultEnvelope::fromJson($json);
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
     * Marks the documents that Payabli requested during review as provided, when the application is in `pendingdocuments`. It returns the application to review. The request has no body.
     *
     * Example:
     * ```php
     * $client->applications->provideDocuments(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TransitionResultEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function provideDocuments(string $requestsReference, ?array $options = null): ?TransitionResultEnvelope
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
                    path: "v2/requests/{$requestsReference}/provide-documents",
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
                return TransitionResultEnvelope::fromJson($json);
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
     * Marks the information that Payabli requested during review as provided, when the application is in `pendingresponse`. It returns the application to review. The request has no body.
     *
     * Example:
     * ```php
     * $client->applications->provideResponse(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TransitionResultEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function provideResponse(string $requestsReference, ?array $options = null): ?TransitionResultEnvelope
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
                    path: "v2/requests/{$requestsReference}/provide-response",
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
                return TransitionResultEnvelope::fromJson($json);
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
     * Withdraws a boarding application. The response returns the application's
     * new status and the actions now allowed on it.
     *
     * Example:
     * ```php
     * $client->applications->withdrawApplication(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     *     new WithdrawApplicationRequest([
     *         'reason' => 'Duplicate application',
     *     ]),
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param WithdrawApplicationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TransitionResultEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function withdrawApplication(string $requestsReference, WithdrawApplicationRequest $request = new WithdrawApplicationRequest(), ?array $options = null): ?TransitionResultEnvelope
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
                    path: "v2/requests/{$requestsReference}/withdraw",
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
                return TransitionResultEnvelope::fromJson($json);
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
     * Retrieves the status transition history of a boarding application, oldest first. History records changes only. An approved application that fails enablement the same way on every attempt doesn't add entries, so use [enablement](/developers/api-reference/applications/get-application-enablement-progress) to follow that progress.
     *
     * Example:
     * ```php
     * $client->applications->getApplicationHistory(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?StatusHistoryEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplicationHistory(string $requestsReference, ?array $options = null): ?StatusHistoryEnvelope
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
                    path: "v2/requests/{$requestsReference}/history",
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
                return StatusHistoryEnvelope::fromJson($json);
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
     * Retrieves the progress of setting up an approved application's services with their processors. An application's status stays `approved` or `autoapproved` while this runs, and it moves to `activated` after every requested service is set up. Use this endpoint to see why an approved merchant isn't live yet.
     *
     * Enablement doesn't send webhooks, so poll this endpoint to follow it. Until enablement starts, `state` and the other progress fields are `null`, and `services` is empty. That includes applications that are in `draft`, withdrawn, or in `error`.
     *
     * Example:
     * ```php
     * $client->applications->getApplicationEnablement(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?EnablementEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplicationEnablement(string $requestsReference, ?array $options = null): ?EnablementEnvelope
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
                    path: "v2/requests/{$requestsReference}/enablement",
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
                return EnablementEnvelope::fromJson($json);
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
     * Lists the documents an application asks for, from its template and from Payabli business rules. For example, a business with an annual revenue of $1,000,000 or more needs bank statements. Each requirement gives the `fieldPath` and `subject` to send when you upload, the formats it accepts, how many documents it takes, and how many are uploaded so far.
     *
     * A person requirement appears once for each owner of the business, with that owner's `personReference`. The list is empty when the application asks for no documents.
     *
     * Example:
     * ```php
     * $client->applications->listApplicationDocumentRequirements(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DocumentRequirementListEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listApplicationDocumentRequirements(string $requestsReference, ?array $options = null): ?DocumentRequirementListEnvelope
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
                    path: "v2/requests/{$requestsReference}/documents/requirements",
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
                return DocumentRequirementListEnvelope::fromJson($json);
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
     * Lists the documents uploaded to an application. The list is empty when none are uploaded.
     *
     * Example:
     * ```php
     * $client->applications->listApplicationDocuments(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationDocumentListEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listApplicationDocuments(string $requestsReference, ?array $options = null): ?ApplicationDocumentListEnvelope
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
                    path: "v2/requests/{$requestsReference}/documents",
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
                return ApplicationDocumentListEnvelope::fromJson($json);
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
     * Uploads one document to an application as multipart form data. [List the application's document requirements](/developers/api-reference/applications/list-application-document-requirements) first. Send the requirement's `fieldPath`, one of its `subjectTypes` as `subject`, and, for a person requirement, its `personReference`.
     *
     * The file can be up to 10 MB, in a format the requirement accepts. Payabli checks the file's content, not only its name. Each requirement takes up to `maxUploads` documents.
     *
     * Uploading doesn't change the application's status. When underwriting requests documents, upload them, then call [provide documents](/developers/api-reference/applications/provide-application-documents) to return the application to review.
     *
     * Example:
     * ```php
     * $client->applications->uploadApplicationDocument(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     *     new UploadApplicationDocumentRequest([
     *         'file' => File::createFromString("example_file", "example_file"),
     *         'fieldPath' => 'documents.bankStatement',
     *         'subject' => DocumentSubjectType::Business->value,
     *     ]),
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param UploadApplicationDocumentRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     * } $options
     * @return ?ApplicationDocumentEnvelope
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function uploadApplicationDocument(string $requestsReference, UploadApplicationDocumentRequest $request, ?array $options = null): ?ApplicationDocumentEnvelope
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $body = new MultipartFormData();
        $body->addPart($request->file->toMultipartFormDataPart('file'));
        $body->add(name: 'fieldPath', value: $request->fieldPath);
        $body->add(name: 'subject', value: $request->subject);
        if ($request->personReference != null) {
            $body->add(name: 'personReference', value: $request->personReference);
        }
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/requests/{$requestsReference}/documents",
                    method: HttpMethod::POST,
                    body: $body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ApplicationDocumentEnvelope::fromJson($json);
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
     * Removes a document you uploaded from an application. Deleting doesn't change the application's status. A deleted document no longer counts toward its requirement, so you can upload a replacement. Deleting a document that's already deleted returns `404`.
     *
     * Example:
     * ```php
     * $client->applications->deleteApplicationDocument(
     *     '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
     *     '019ff1d7-6e14-7c8b-a2f5-91d3b7e04c62',
     * );
     * ```
     *
     * @param string $requestsReference The application reference.
     * @param string $documentReference The document reference, from the upload response or [List application documents](/developers/api-reference/applications/list-application-documents).
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
    public function deleteApplicationDocument(string $requestsReference, string $documentReference, ?array $options = null): void
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
                    path: "v2/requests/{$requestsReference}/documents/{$documentReference}",
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
}
