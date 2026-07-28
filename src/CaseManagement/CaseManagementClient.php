<?php

namespace Payabli\CaseManagement;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\CaseManagement\Requests\ValidateBankAccountChangeRequest;
use Payabli\Types\PreCreationValidationResult;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\CaseManagement\Requests\CreateBankAccountChangeCaseRequest;
use Payabli\Types\CaseResponse;
use Payabli\CaseManagement\Requests\ListCasesCaseManagementRequest;
use Payabli\Types\CaseListResponse;
use Payabli\CaseManagement\Requests\ListMessagesCaseManagementRequest;
use Payabli\Types\MessagePage;
use Payabli\CaseManagement\Requests\PostCaseMessageRequest;
use Payabli\Types\PostedMessage;
use Payabli\Types\AvailableTransitionsResponse;
use Payabli\CaseManagement\Requests\TransitionCaseRequest;
use Payabli\CaseManagement\Requests\AssignCaseRequest;
use Payabli\Types\AttachmentResponse;
use Payabli\Core\Json\JsonDecoder;
use Payabli\CaseManagement\Requests\UploadAttachmentCaseManagementRequest;
use Payabli\Core\Multipart\MultipartFormData;
use Payabli\Core\Multipart\MultipartApiRequest;

class CaseManagementClient
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
     * Validates a bank account change for a paypoint without creating a case.
     * Runs the same checks the create endpoint runs, and returns blocking
     * conditions and warnings. Blocking conditions prevent creation; warnings
     * don't.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->validateBankAccountChange(
     *     3040,
     *     new ValidateBankAccountChangeRequest([
     *         'routingNumber' => '123456789',
     *         'accountNumber' => '987654321',
     *         'accountType' => 'checking',
     *         'bankAccountHolderType' => 'business',
     *         'bankAccountFunction' => CaseManagementBankAccountFunction::Deposits->value,
     *         'services' => new BankAccountServices([
     *             'moneyIn' => [
     *                 MoneyInService::Ach->value,
     *             ],
     *             'moneyOut' => [
     *                 MoneyOutService::Ach->value,
     *             ],
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $paypointId The paypoint's numeric identifier.
     * @param ValidateBankAccountChangeRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PreCreationValidationResult
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function validateBankAccountChange(int $paypointId, ValidateBankAccountChangeRequest $request, ?array $options = null): ?PreCreationValidationResult
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
                    path: "v2/cases/bank-account/{$paypointId}/validate",
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
                return PreCreationValidationResult::fromJson($json);
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
     * Creates a bank-account-change case for a paypoint. The account and
     * routing numbers are validated and tokenized before the case is saved —
     * the raw numbers are never stored or returned. The account holder name is
     * taken from the paypoint's legal name. On success the case is created in
     * `Submitted` and asynchronous verification starts.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->createBankAccountChange(
     *     3040,
     *     new CreateBankAccountChangeCaseRequest([
     *         'nickname' => 'Main Settlement Account',
     *         'bankName' => 'First National Bank',
     *         'routingNumber' => '123456789',
     *         'accountNumber' => '987654321',
     *         'accountType' => 'checking',
     *         'bankAccountHolderType' => 'business',
     *         'bankAccountFunction' => CaseManagementBankAccountFunction::Deposits->value,
     *         'services' => new BankAccountServices([
     *             'moneyIn' => [
     *                 MoneyInService::Ach->value,
     *             ],
     *             'moneyOut' => [
     *                 MoneyOutService::Ach->value,
     *             ],
     *         ]),
     *         'default' => true,
     *     ]),
     * );
     * ```
     *
     * @param int $paypointId The paypoint's numeric identifier.
     * @param CreateBankAccountChangeCaseRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaseResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createBankAccountChange(int $paypointId, CreateBankAccountChangeCaseRequest $request, ?array $options = null): ?CaseResponse
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
                    path: "v2/cases/bank-account/{$paypointId}",
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
                return CaseResponse::fromJson($json);
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
     * Returns a case by its UUID, including its current state, parameters,
     * state history, verification metadata, and attachments.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->getCase(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     * );
     * ```
     *
     * @param string $uuid The case's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaseResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getCase(string $uuid, ?array $options = null): ?CaseResponse
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
                    path: "v2/cases/{$uuid}",
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
                return CaseResponse::fromJson($json);
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
     * Lists cases for an organization, climbing the platform org hierarchy.
     * Supports pagination and sorting through query parameters, and filtering
     * through repeatable `parameters[field(op)]=value` query parameters (for
     * example `parameters[state(in)]=Assigned|PendingReview`). Filterable
     * fields include `state`, `caseType`, `paypointId`, `createdAt`,
     * `updatedAt`, `scheduleFor`, and `createdBy`.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->listCases(
     *     123,
     *     new ListCasesCaseManagementRequest([
     *         'fromRecord' => 0,
     *         'limitRecord' => 20,
     *     ]),
     * );
     * ```
     *
     * @param int $organizationId The organization's numeric identifier.
     * @param ListCasesCaseManagementRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaseListResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listCases(int $organizationId, ListCasesCaseManagementRequest $request = new ListCasesCaseManagementRequest(), ?array $options = null): ?CaseListResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/cases/organization/{$organizationId}",
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
                return CaseListResponse::fromJson($json);
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
     * Lists the notes on a case, ordered oldest to newest. Cursor-paginated.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->listMessages(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     *     new ListMessagesCaseManagementRequest([]),
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param ListMessagesCaseManagementRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MessagePage
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listMessages(string $caseUuid, ListMessagesCaseManagementRequest $request = new ListMessagesCaseManagementRequest(), ?array $options = null): ?MessagePage
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/cases/{$caseUuid}/messages",
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
                return MessagePage::fromJson($json);
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
     * Adds a note to a case.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * This endpoint is in development and not yet available for API use. To
     * add a note for now, use Case Management in the
     * [Payabli Portal](/guides/pay-ops-portal-bank-account-changes-manage).
     * To read existing notes on a case, use
     * [List case notes](/developers/api-reference/caseManagement/list-case-notes).
     *
     * Example:
     * ```php
     * $client->caseManagement->postMessage(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     *     new PostCaseMessageRequest([
     *         'content' => 'Reviewed supporting documents; account ownership confirmed.',
     *     ]),
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param PostCaseMessageRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PostedMessage
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function postMessage(string $caseUuid, PostCaseMessageRequest $request, ?array $options = null): ?PostedMessage
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
                    path: "v2/cases/{$caseUuid}/messages",
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
                return PostedMessage::fromJson($json);
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
     * Lists the review actions currently available on a case. The list is
     * empty when no user action is available (for example while the case is
     * mid-automation).
     *
     * Available to both Platform and Enterprise Partners, though only
     * Enterprise Partners can fire the returned actions.
     *
     * Example:
     * ```php
     * $client->caseManagement->listTransitions(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     * );
     * ```
     *
     * @param string $uuid The case's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AvailableTransitionsResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listTransitions(string $uuid, ?array $options = null): ?AvailableTransitionsResponse
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
                    path: "v2/cases/{$uuid}/transitions",
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
                return AvailableTransitionsResponse::fromJson($json);
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
     * Fires a review action on a case, such as `Approve`, `Deny`, `Escalate`,
     * or `RequestReview`. Assigning a case uses the dedicated assign endpoint,
     * not this one. Firing an action that isn't valid for the case's current
     * state returns `409`.
     *
     * Available to Enterprise Partners only.
     *
     * Example:
     * ```php
     * $client->caseManagement->transition(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     *     new TransitionCaseRequest([
     *         'trigger' => CaseTrigger::Approve->value,
     *         'reason' => 'Account ownership confirmed with the merchant by phone.',
     *     ]),
     * );
     * ```
     *
     * @param string $uuid The case's UUID.
     * @param TransitionCaseRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaseResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function transition(string $uuid, TransitionCaseRequest $request, ?array $options = null): ?CaseResponse
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
                    path: "v2/cases/{$uuid}/transitions",
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
                return CaseResponse::fromJson($json);
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
     * Assigns a case to a reviewer.
     *
     * Available to Enterprise Partners only.
     *
     * Example:
     * ```php
     * $client->caseManagement->assignCase(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     *     new AssignCaseRequest([
     *         'assigneeId' => 4238,
     *         'reason' => 'Routing to the risk team for review.',
     *     ]),
     * );
     * ```
     *
     * @param string $uuid The case's UUID.
     * @param AssignCaseRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CaseResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function assignCase(string $uuid, AssignCaseRequest $request, ?array $options = null): ?CaseResponse
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
                    path: "v2/cases/{$uuid}/assign",
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
                return CaseResponse::fromJson($json);
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
     * Lists the files attached to a case.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->listAttachments(
     *     '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<AttachmentResponse>
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listAttachments(string $caseUuid, ?array $options = null): ?array
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
                    path: "v2/cases/{$caseUuid}/attachments",
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
                return JsonDecoder::decodeArray($json, [AttachmentResponse::class]); // @phpstan-ignore-line
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
     * Uploads a file to a case as multipart form data. The maximum size is
     * 25 MiB, and the content type must be an allowed type such as PDF, PNG,
     * JPEG, CSV, XLSX, DOCX, or plain text.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->uploadAttachment(
     *     'caseUuid',
     *     new UploadAttachmentCaseManagementRequest([
     *         'file' => File::createFromString("example_file", "example_file"),
     *     ]),
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param UploadAttachmentCaseManagementRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     * } $options
     * @return ?AttachmentResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function uploadAttachment(string $caseUuid, UploadAttachmentCaseManagementRequest $request, ?array $options = null): ?AttachmentResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $body = new MultipartFormData();
        $body->addPart($request->file->toMultipartFormDataPart('file'));
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/cases/{$caseUuid}/attachments",
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
                return AttachmentResponse::fromJson($json);
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
     * Streams the file content of an attachment.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->getAttachment(
     *     'caseUuid',
     *     'attachmentId',
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param string $attachmentId The attachment's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return string
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getAttachment(string $caseUuid, string $attachmentId, ?array $options = null): string
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
                    path: "v2/cases/{$caseUuid}/attachments/{$attachmentId}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return $response->getBody()->getContents();
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
     * Deletes an attachment from a case.
     *
     * Available to both Platform and Enterprise Partners.
     *
     * Example:
     * ```php
     * $client->caseManagement->deleteAttachment(
     *     'caseUuid',
     *     'attachmentId',
     * );
     * ```
     *
     * @param string $caseUuid The case's UUID.
     * @param string $attachmentId The attachment's UUID.
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
    public function deleteAttachment(string $caseUuid, string $attachmentId, ?array $options = null): void
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
                    path: "v2/cases/{$caseUuid}/attachments/{$attachmentId}",
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
