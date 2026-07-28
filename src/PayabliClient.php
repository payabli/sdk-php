<?php

namespace Payabli;

use Payabli\Bill\BillClient;
use Payabli\Customer\CustomerClient;
use Payabli\CheckCapture\CheckCaptureClient;
use Payabli\MoneyIn\MoneyInClient;
use Payabli\Token\TokenClient;
use Payabli\Subscription\SubscriptionClient;
use Payabli\Invoice\InvoiceClient;
use Payabli\PaymentLink\PaymentLinkClient;
use Payabli\TokenStorage\TokenStorageClient;
use Payabli\Paypoint\PaypointClient;
use Payabli\HostedPaymentPages\HostedPaymentPagesClient;
use Payabli\PaymentMethodDomain\PaymentMethodDomainClient;
use Payabli\Import\ImportClient;
use Payabli\Query\QueryClient;
use Payabli\Ocr\OcrClient;
use Payabli\Notificationlogs\NotificationlogsClient;
use Payabli\Cloud\CloudClient;
use Payabli\LineItem\LineItemClient;
use Payabli\Boarding\BoardingClient;
use Payabli\Templates\TemplatesClient;
use Payabli\Export\ExportClient;
use Payabli\Organization\OrganizationClient;
use Payabli\Management\ManagementClient;
use Payabli\Statistic\StatisticClient;
use Payabli\Notification\NotificationClient;
use Payabli\User\UserClient;
use Payabli\Vendor\VendorClient;
use Payabli\GhostCard\GhostCardClient;
use Payabli\MoneyOut\MoneyOutClient;
use Payabli\Funding\FundingClient;
use Payabli\Wallet\WalletClient;
use Payabli\PayoutSubscription\PayoutSubscriptionClient;
use Payabli\ChargeBacks\ChargeBacksClient;
use Payabli\CaseManagement\CaseManagementClient;
use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Core\OAuthTokenProvider;

class PayabliClient
{
    /**
     * @var BillClient $bill
     */
    public BillClient $bill;

    /**
     * @var CustomerClient $customer
     */
    public CustomerClient $customer;

    /**
     * @var CheckCaptureClient $checkCapture
     */
    public CheckCaptureClient $checkCapture;

    /**
     * @var MoneyInClient $moneyIn
     */
    public MoneyInClient $moneyIn;

    /**
     * @var TokenClient $token
     */
    public TokenClient $token;

    /**
     * @var SubscriptionClient $subscription
     */
    public SubscriptionClient $subscription;

    /**
     * @var InvoiceClient $invoice
     */
    public InvoiceClient $invoice;

    /**
     * @var PaymentLinkClient $paymentLink
     */
    public PaymentLinkClient $paymentLink;

    /**
     * @var TokenStorageClient $tokenStorage
     */
    public TokenStorageClient $tokenStorage;

    /**
     * @var PaypointClient $paypoint
     */
    public PaypointClient $paypoint;

    /**
     * @var HostedPaymentPagesClient $hostedPaymentPages
     */
    public HostedPaymentPagesClient $hostedPaymentPages;

    /**
     * @var PaymentMethodDomainClient $paymentMethodDomain
     */
    public PaymentMethodDomainClient $paymentMethodDomain;

    /**
     * @var ImportClient $import
     */
    public ImportClient $import;

    /**
     * @var QueryClient $query
     */
    public QueryClient $query;

    /**
     * @var OcrClient $ocr
     */
    public OcrClient $ocr;

    /**
     * @var NotificationlogsClient $notificationlogs
     */
    public NotificationlogsClient $notificationlogs;

    /**
     * @var CloudClient $cloud
     */
    public CloudClient $cloud;

    /**
     * @var LineItemClient $lineItem
     */
    public LineItemClient $lineItem;

    /**
     * @var BoardingClient $boarding
     */
    public BoardingClient $boarding;

    /**
     * @var TemplatesClient $templates
     */
    public TemplatesClient $templates;

    /**
     * @var ExportClient $export
     */
    public ExportClient $export;

    /**
     * @var OrganizationClient $organization
     */
    public OrganizationClient $organization;

    /**
     * @var ManagementClient $management
     */
    public ManagementClient $management;

    /**
     * @var StatisticClient $statistic
     */
    public StatisticClient $statistic;

    /**
     * @var NotificationClient $notification
     */
    public NotificationClient $notification;

    /**
     * @var UserClient $user
     */
    public UserClient $user;

    /**
     * @var VendorClient $vendor
     */
    public VendorClient $vendor;

    /**
     * @var GhostCardClient $ghostCard
     */
    public GhostCardClient $ghostCard;

    /**
     * @var MoneyOutClient $moneyOut
     */
    public MoneyOutClient $moneyOut;

    /**
     * @var FundingClient $funding
     */
    public FundingClient $funding;

    /**
     * @var WalletClient $wallet
     */
    public WalletClient $wallet;

    /**
     * @var PayoutSubscriptionClient $payoutSubscription
     */
    public PayoutSubscriptionClient $payoutSubscription;

    /**
     * @var ChargeBacksClient $chargeBacks
     */
    public ChargeBacksClient $chargeBacks;

    /**
     * @var CaseManagementClient $caseManagement
     */
    public CaseManagementClient $caseManagement;

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
     * @param ?string $clientId The client ID for OAuth authentication.
     * @param ?string $clientSecret The client secret for OAuth authentication.
     * @param ?string $apiKey The apiKey to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        ?string $clientId = null,
        ?string $clientSecret = null,
        ?string $apiKey = null,
        ?array $options = null,
    ) {
        $clientId ??= getenv('OAUTH_CLIENT_ID') ?: null;
        $clientSecret ??= getenv('OAUTH_CLIENT_SECRET') ?: null;
        $defaultHeaders = [
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Payabli',
            'X-Fern-SDK-Version' => '1.0.9',
            'User-Agent' => 'payabli/payabli/1.0.9',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $oauthTokenProvider = null;
        if ($clientId !== null && $clientSecret !== null) {
            $authRawClient = new RawClient(['baseUrl' => $this->options['baseUrl'] ?? '', 'headers' => []]);
            $authClient = new TokenClient($authRawClient);
            $oauthTokenProvider = new OAuthTokenProvider($clientId, $clientSecret, $authClient);

        }
        $this->routingAuthProvider = new RoutingAuthProvider(
            $oauthTokenProvider,
            $apiKey,
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->bill = new BillClient($this->client, $this->options, $this->routingAuthProvider);
        $this->customer = new CustomerClient($this->client, $this->options, $this->routingAuthProvider);
        $this->checkCapture = new CheckCaptureClient($this->client, $this->options, $this->routingAuthProvider);
        $this->moneyIn = new MoneyInClient($this->client, $this->options, $this->routingAuthProvider);
        $this->token = new TokenClient($this->client, $this->options, $this->routingAuthProvider);
        $this->subscription = new SubscriptionClient($this->client, $this->options, $this->routingAuthProvider);
        $this->invoice = new InvoiceClient($this->client, $this->options, $this->routingAuthProvider);
        $this->paymentLink = new PaymentLinkClient($this->client, $this->options, $this->routingAuthProvider);
        $this->tokenStorage = new TokenStorageClient($this->client, $this->options, $this->routingAuthProvider);
        $this->paypoint = new PaypointClient($this->client, $this->options, $this->routingAuthProvider);
        $this->hostedPaymentPages = new HostedPaymentPagesClient($this->client, $this->options, $this->routingAuthProvider);
        $this->paymentMethodDomain = new PaymentMethodDomainClient($this->client, $this->options, $this->routingAuthProvider);
        $this->import = new ImportClient($this->client, $this->options, $this->routingAuthProvider);
        $this->query = new QueryClient($this->client, $this->options, $this->routingAuthProvider);
        $this->ocr = new OcrClient($this->client, $this->options, $this->routingAuthProvider);
        $this->notificationlogs = new NotificationlogsClient($this->client, $this->options, $this->routingAuthProvider);
        $this->cloud = new CloudClient($this->client, $this->options, $this->routingAuthProvider);
        $this->lineItem = new LineItemClient($this->client, $this->options, $this->routingAuthProvider);
        $this->boarding = new BoardingClient($this->client, $this->options, $this->routingAuthProvider);
        $this->templates = new TemplatesClient($this->client, $this->options, $this->routingAuthProvider);
        $this->export = new ExportClient($this->client, $this->options, $this->routingAuthProvider);
        $this->organization = new OrganizationClient($this->client, $this->options, $this->routingAuthProvider);
        $this->management = new ManagementClient($this->client, $this->options, $this->routingAuthProvider);
        $this->statistic = new StatisticClient($this->client, $this->options, $this->routingAuthProvider);
        $this->notification = new NotificationClient($this->client, $this->options, $this->routingAuthProvider);
        $this->user = new UserClient($this->client, $this->options, $this->routingAuthProvider);
        $this->vendor = new VendorClient($this->client, $this->options, $this->routingAuthProvider);
        $this->ghostCard = new GhostCardClient($this->client, $this->options, $this->routingAuthProvider);
        $this->moneyOut = new MoneyOutClient($this->client, $this->options, $this->routingAuthProvider);
        $this->funding = new FundingClient($this->client, $this->options, $this->routingAuthProvider);
        $this->wallet = new WalletClient($this->client, $this->options, $this->routingAuthProvider);
        $this->payoutSubscription = new PayoutSubscriptionClient($this->client, $this->options, $this->routingAuthProvider);
        $this->chargeBacks = new ChargeBacksClient($this->client, $this->options, $this->routingAuthProvider);
        $this->caseManagement = new CaseManagementClient($this->client, $this->options, $this->routingAuthProvider);
    }
}
