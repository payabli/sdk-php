<?php

namespace Payabli\Boarding;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Types\ApplicationDataPayIn;
use Payabli\Types\ApplicationDataManaged;
use Payabli\Types\ApplicationDataOdp;
use Payabli\Types\ApplicationData;
use Payabli\Types\PayabliApiResponse00Responsedatanonobject;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use Payabli\Core\Json\JsonSerializer;
use Payabli\Core\Types\Union;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\ApplicationDetailsRecord;
use Payabli\Boarding\Requests\RequestAppByAuth;
use Payabli\Types\ApplicationQueryRecord;
use Payabli\Types\BoardingLinkQueryRecord;
use Payabli\Boarding\Requests\GetExternalApplicationRequest;
use Payabli\Types\PayabliApiResponse00;
use Payabli\Boarding\Requests\ListApplicationsRequest;
use Payabli\Types\QueryBoardingAppsListResponse;
use Payabli\Boarding\Requests\ListBoardingLinksRequest;
use Payabli\Types\QueryBoardingLinksResponse;
use Payabli\Boarding\Requests\CreateApplicationFromPaypointRequest;
use Payabli\Types\CreateApplicationFromPaypointResponse;

class BoardingClient
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
     * Creates a boarding application in an organization. This endpoint requires an application API token.
     *
     * Example:
     * ```php
     * $client->boarding->addApplication(
     *     new ApplicationDataPayIn([
     *         'services' => new ApplicationDataPayInServices([
     *             'ach' => new AchSetup([]),
     *             'card' => new CardSetup([
     *                 'acceptAmex' => true,
     *                 'acceptDiscover' => true,
     *                 'acceptMastercard' => true,
     *                 'acceptVisa' => true,
     *             ]),
     *         ]),
     *         'annualRevenue' => 1000,
     *         'averageBillSize' => '500',
     *         'averageMonthlyBill' => '5650',
     *         'avgmonthly' => 1000,
     *         'baddress' => '123 Walnut Street',
     *         'baddress1' => 'Suite 103',
     *         'bankData' => [
     *             new Bank([
     *                 'accountId' => '123-456',
     *                 'nickname' => 'Withdrawal Account',
     *                 'bankName' => 'Test Bank 1',
     *                 'routingAccount' => '123123123',
     *                 'accountNumber' => '123123100',
     *                 'typeAccount' => TypeAccount::Checking->value,
     *                 'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
     *                 'bankAccountHolderType' => BankAccountHolderType::Business->value,
     *                 'bankAccountFunction' => 1,
     *             ]),
     *             new Bank([
     *                 'accountId' => '123-789',
     *                 'nickname' => 'Deposit Account',
     *                 'bankName' => 'Test Bank 2',
     *                 'routingAccount' => '321321321',
     *                 'accountNumber' => '123123200',
     *                 'typeAccount' => TypeAccount::Checking->value,
     *                 'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
     *                 'bankAccountHolderType' => BankAccountHolderType::Business->value,
     *                 'bankAccountFunction' => 0,
     *             ]),
     *         ],
     *         'bcity' => 'New Vegas',
     *         'bcountry' => 'US',
     *         'binperson' => 60,
     *         'binphone' => 20,
     *         'binweb' => 20,
     *         'bstate' => 'FL',
     *         'bsummary' => 'Brick and mortar store that sells office supplies',
     *         'btype' => OwnType::LimitedLiabilityCompany->value,
     *         'bzip' => '33000',
     *         'contacts' => [
     *             new Contacts([
     *                 'contactEmail' => 'herman@hermanscoatings.com',
     *                 'contactName' => 'Herman Martinez',
     *                 'contactPhone' => '3055550000',
     *                 'contactTitle' => 'Owner',
     *             ]),
     *         ],
     *         'creditLimit' => 'creditLimit',
     *         'dbaName' => 'Sunshine Gutters',
     *         'ein' => '123456789',
     *         'faxnumber' => '1234567890',
     *         'highticketamt' => 1000,
     *         'legalName' => 'Sunshine Services, LLC',
     *         'license' => '2222222FFG',
     *         'licstate' => 'CA',
     *         'maddress' => '123 Walnut Street',
     *         'maddress1' => 'STE 900',
     *         'mcc' => '7777',
     *         'mcity' => 'Johnson City',
     *         'mcountry' => 'US',
     *         'mstate' => 'TN',
     *         'mzip' => '37615',
     *         'orgId' => 123,
     *         'ownership' => [
     *             new Owners([
     *                 'ownername' => 'John Smith',
     *                 'ownertitle' => 'CEO',
     *                 'ownerpercent' => 100,
     *                 'ownerssn' => '123456789',
     *                 'ownerdob' => '01/01/1990',
     *                 'ownerphone1' => '555888111',
     *                 'ownerphone2' => '555888111',
     *                 'owneremail' => 'test@email.com',
     *                 'ownerdriver' => 'CA6677778',
     *                 'oaddress' => '33 North St',
     *                 'ocity' => 'Any City',
     *                 'ocountry' => 'US',
     *                 'odriverstate' => 'CA',
     *                 'ostate' => 'CA',
     *                 'ozip' => '55555',
     *             ]),
     *         ],
     *         'phonenumber' => '1234567890',
     *         'processingRegion' => 'US',
     *         'recipientEmail' => 'josephray@example.com',
     *         'recipientEmailNotification' => true,
     *         'resumable' => true,
     *         'signer' => new SignerDataRequest([
     *             'name' => 'John Smith',
     *             'ssn' => '123456789',
     *             'dob' => '01/01/1976',
     *             'phone' => '555888111',
     *             'email' => 'test@email.com',
     *             'address' => '33 North St',
     *             'address1' => 'STE 900',
     *             'city' => 'Bristol',
     *             'country' => 'US',
     *             'state' => 'TN',
     *             'zip' => '55555',
     *             'signedDocumentReference' => 'https://example.com/signed-document.pdf',
     *             'pciAttestation' => true,
     *             'attestationDate' => '04/20/2025',
     *             'additionalData' => [
     *                 'deviceId' => '499585-389fj484-3jcj8hj3',
     *                 'session' => 'fifji4-fiu443-fn4843',
     *                 'timeWithCompany' => '6 Years',
     *             ],
     *             'signDate' => '04/20/2025',
     *         ]),
     *         'startdate' => '01/01/1990',
     *         'taxFillName' => 'Sunshine LLC',
     *         'templateId' => 22,
     *         'ticketamt' => 1000,
     *         'website' => 'www.example.com',
     *         'whenCharged' => Whencharged::WhenServiceProvided->value,
     *         'whenDelivered' => Whendelivered::Over30Days->value,
     *         'whenProvided' => Whenprovided::ThirtyDaysOrLess->value,
     *         'whenRefunded' => Whenrefunded::ThirtyDaysOrLess->value,
     *     ]),
     * );
     * ```
     *
     * @param (
     *    ApplicationDataPayIn
     *   |ApplicationDataManaged
     *   |ApplicationDataOdp
     *   |ApplicationData
     * ) $request
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
    public function addApplication(ApplicationDataPayIn|ApplicationDataManaged|ApplicationDataOdp|ApplicationData $request, ?array $options = null): ?PayabliApiResponse00Responsedatanonobject
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
                    path: "Boarding/app",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(ApplicationDataPayIn::class, ApplicationDataManaged::class, ApplicationDataOdp::class, ApplicationData::class)),
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
     * Updates a boarding application by ID. This endpoint requires an application API token.
     *
     * Example:
     * ```php
     * $client->boarding->updateApplication(
     *     352,
     *     new ApplicationData([]),
     * );
     * ```
     *
     * @param int $appId Boarding application ID.
     * @param ApplicationData $request
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
    public function updateApplication(int $appId, ApplicationData $request, ?array $options = null): ?PayabliApiResponse00Responsedatanonobject
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
                    path: "Boarding/app/{$appId}",
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
     * Deletes a boarding application by ID.
     *
     * Example:
     * ```php
     * $client->boarding->deleteApplication(
     *     352,
     * );
     * ```
     *
     * @param int $appId Boarding application ID.
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
    public function deleteApplication(int $appId, ?array $options = null): ?PayabliApiResponse00Responsedatanonobject
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
                    path: "Boarding/app/{$appId}",
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
     * Retrieves the details for a boarding application by ID.
     *
     * Example:
     * ```php
     * $client->boarding->getApplication(
     *     352,
     * );
     * ```
     *
     * @param int $appId Boarding application ID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationDetailsRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplication(int $appId, ?array $options = null): ?ApplicationDetailsRecord
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
                    path: "Boarding/read/{$appId}",
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
                return ApplicationDetailsRecord::fromJson($json);
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
     * Gets a boarding application by authentication information. This endpoint requires an `application` API token.
     *
     * Example:
     * ```php
     * $client->boarding->getApplicationByAuth(
     *     '17E',
     *     new RequestAppByAuth([
     *         'email' => 'admin@email.com',
     *         'referenceId' => '129-219',
     *     ]),
     * );
     * ```
     *
     * @param string $xId The application ID in Hex format. Find this at the end of the boarding link URL returned in a call to api/Boarding/applink/{appId}/{mail2}. For example in:  `https://boarding-sandbox.payabli.com/boarding/externalapp/load/17E`, the xId is `17E`.
     * @param RequestAppByAuth $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ApplicationQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplicationByAuth(string $xId, RequestAppByAuth $request = new RequestAppByAuth(), ?array $options = null): ?ApplicationQueryRecord
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
                    path: "Boarding/read/{$xId}",
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
                return ApplicationQueryRecord::fromJson($json);
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
     * Retrieves details for a boarding link, by ID.
     *
     * Example:
     * ```php
     * $client->boarding->getByIdLinkApplication(
     *     91,
     * );
     * ```
     *
     * @param int $boardingLinkId The boarding link ID. You can find this at the end of the boarding link reference name. For example `https://boarding.payabli.com/boarding/app/myorgaccountname-00091`. The ID is `91`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BoardingLinkQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getByIdLinkApplication(int $boardingLinkId, ?array $options = null): ?BoardingLinkQueryRecord
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
                    path: "Boarding/linkbyId/{$boardingLinkId}",
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
                return BoardingLinkQueryRecord::fromJson($json);
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
     * Get details for a boarding link using the boarding template ID. This endpoint requires an application API token.
     *
     * Example:
     * ```php
     * $client->boarding->getByTemplateIdLinkApplication(
     *     80,
     * );
     * ```
     *
     * @param float $templateId The boarding template ID. You can find this at the end of the boarding template URL in the Payabli Portal. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BoardingLinkQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getByTemplateIdLinkApplication(float $templateId, ?array $options = null): ?BoardingLinkQueryRecord
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
                    path: "Boarding/linkbyTemplate/{$templateId}",
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
                return BoardingLinkQueryRecord::fromJson($json);
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
     * Retrieves a link and the verification code used to log into an existing boarding application. You can also use this endpoint to send a link and referenceId for an existing boarding application to an email address. The recipient can use the referenceId and email address to access and edit the application.
     *
     * Example:
     * ```php
     * $client->boarding->getExternalApplication(
     *     352,
     *     'mail2',
     *     new GetExternalApplicationRequest([]),
     * );
     * ```
     *
     * @param int $appId Boarding application ID.
     * @param string $mail2 Email address used to access the application. If `sendEmail` parameter is true, a link to the application is sent to this email address.
     * @param GetExternalApplicationRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponse00
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getExternalApplication(int $appId, string $mail2, GetExternalApplicationRequest $request = new GetExternalApplicationRequest(), ?array $options = null): ?PayabliApiResponse00
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->sendEmail != null) {
            $query['sendEmail'] = $request->sendEmail;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Boarding/applink/{$appId}/{$mail2}",
                    method: HttpMethod::PUT,
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
                return PayabliApiResponse00::fromJson($json);
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
     * Retrieves the details for a boarding link, by reference name. This endpoint requires an application API token.
     *
     * Example:
     * ```php
     * $client->boarding->getLinkApplication(
     *     'myorgaccountname-00091',
     * );
     * ```
     *
     * @param string $boardingLinkReference The boarding link reference name. You can find this at the end of the boarding link URL. For example `https://boarding.payabli.com/boarding/app/myorgaccountname-00091`
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BoardingLinkQueryRecord
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getLinkApplication(string $boardingLinkReference, ?array $options = null): ?BoardingLinkQueryRecord
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
                    path: "Boarding/link/{$boardingLinkReference}",
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
                return BoardingLinkQueryRecord::fromJson($json);
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
     * Returns a list of boarding applications for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
     *
     * Example:
     * ```php
     * $client->boarding->listApplications(
     *     123,
     *     new ListApplicationsRequest([
     *         'fromRecord' => 251,
     *         'limitRecord' => 0,
     *         'sortBy' => 'desc(field_name)',
     *     ]),
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ListApplicationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?QueryBoardingAppsListResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listApplications(int $orgId, ListApplicationsRequest $request = new ListApplicationsRequest(), ?array $options = null): ?QueryBoardingAppsListResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->exportFormat != null) {
            $query['exportFormat'] = $request->exportFormat;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Query/boarding/{$orgId}",
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
                return QueryBoardingAppsListResponse::fromJson($json);
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
     * Return a list of boarding links for an organization. Use filters to limit results.
     *
     * Example:
     * ```php
     * $client->boarding->listBoardingLinks(
     *     123,
     *     new ListBoardingLinksRequest([
     *         'fromRecord' => 251,
     *         'limitRecord' => 0,
     *         'sortBy' => 'desc(field_name)',
     *     ]),
     * );
     * ```
     *
     * @param int $orgId The numeric identifier for organization, assigned by Payabli.
     * @param ListBoardingLinksRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?QueryBoardingLinksResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listBoardingLinks(int $orgId, ListBoardingLinksRequest $request = new ListBoardingLinksRequest(), ?array $options = null): ?QueryBoardingLinksResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        if ($request->parameters != null) {
            $query['parameters'] = $request->parameters;
        }
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Query/boardinglinks/{$orgId}",
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
                return QueryBoardingLinksResponse::fromJson($json);
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
     * Creates a new boarding application linked to an existing paypoint as part of the multi-product boarding flow. Use this endpoint to add new services to a paypoint without creating a duplicate record. The system copies eligible business, contact, banking, and address data from the paypoint to the new application based on 1:1 field matching. The merchant only needs to provide fields that are specific to the new service. See the [Multi-product boarding](/guides/pay-ops-developer-boarding-multi-product) guide for the full flow.
     *
     * Example:
     * ```php
     * $client->boarding->addServiceToPaypointFromApp(
     *     new CreateApplicationFromPaypointRequest([
     *         'paypointId' => 3040,
     *         'templateId' => 456,
     *         'recipientEmail' => 'merchant@example.com',
     *         'returnBoardingAccessInfoInLine' => true,
     *         'onCreate' => [
     *             'submitApplication',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param CreateApplicationFromPaypointRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateApplicationFromPaypointResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addServiceToPaypointFromApp(CreateApplicationFromPaypointRequest $request, ?array $options = null): ?CreateApplicationFromPaypointResponse
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
                    path: "Boarding/applications",
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
                return CreateApplicationFromPaypointResponse::fromJson($json);
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
     * Returns all boarding applications associated with a specific paypoint, including those created through the multi-product boarding flow. Use this endpoint to track underwriting progress across multiple service additions or to build reporting views. See the [Multi-product boarding](/guides/pay-ops-developer-boarding-multi-product) guide for the full flow.
     *
     * Example:
     * ```php
     * $client->boarding->getApplicationsByPaypointId(
     *     3040,
     * );
     * ```
     *
     * @param int $paypointId ID of the paypoint to retrieve applications for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?QueryBoardingAppsListResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getApplicationsByPaypointId(int $paypointId, ?array $options = null): ?QueryBoardingAppsListResponse
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
                    path: "Boarding/applications/{$paypointId}",
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
                return QueryBoardingAppsListResponse::fromJson($json);
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
