<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\AuthorizePaymentMethod;
use Payabli\Types\RequestOutAuthorizePaymentDetails;
use Payabli\Types\RequestOutAuthorizeVendorData;
use Payabli\Types\RequestOutAuthorizeInvoiceData;
use Payabli\Core\Types\ArrayType;

class RequestOutAuthorize extends JsonSerializableType
{
    /**
     * @var ?bool $allowDuplicatedBills When `true`, the authorization bypasses the requirement for unique bills, identified by vendor invoice number. This allows you to make more than one payout authorization for a bill, like a split payment.
     */
    public ?bool $allowDuplicatedBills;

    /**
     * @var ?bool $doNotCreateBills When `true`, Payabli won't automatically create a bill for this payout transaction.
     */
    public ?bool $doNotCreateBills;

    /**
     * @var ?bool $forceVendorCreation When `true`, the request creates a new vendor record, regardless of whether the vendor already exists.
     */
    public ?bool $forceVendorCreation;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var string $entryPoint
     */
    #[JsonProperty('entryPoint')]
    public string $entryPoint;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var AuthorizePaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public AuthorizePaymentMethod $paymentMethod;

    /**
     * @var RequestOutAuthorizePaymentDetails $paymentDetails Object containing payment details.
     */
    #[JsonProperty('paymentDetails')]
    public RequestOutAuthorizePaymentDetails $paymentDetails;

    /**
     * @var RequestOutAuthorizeVendorData $vendorData Object containing vendor data.
     */
    #[JsonProperty('vendorData')]
    public RequestOutAuthorizeVendorData $vendorData;

    /**
     * @var array<RequestOutAuthorizeInvoiceData> $invoiceData Array of bills associated to the transaction
     */
    #[JsonProperty('invoiceData'), ArrayType([RequestOutAuthorizeInvoiceData::class])]
    public array $invoiceData;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $subdomain
     */
    #[JsonProperty('subdomain')]
    public ?string $subdomain;

    /**
     * @var ?int $subscriptionId
     */
    #[JsonProperty('subscriptionId')]
    public ?int $subscriptionId;

    /**
     * @var ?bool $autoCapture
     */
    #[JsonProperty('autoCapture')]
    public ?bool $autoCapture;

    /**
     * @param array{
     *   entryPoint: string,
     *   paymentMethod: AuthorizePaymentMethod,
     *   paymentDetails: RequestOutAuthorizePaymentDetails,
     *   vendorData: RequestOutAuthorizeVendorData,
     *   invoiceData: array<RequestOutAuthorizeInvoiceData>,
     *   allowDuplicatedBills?: ?bool,
     *   doNotCreateBills?: ?bool,
     *   forceVendorCreation?: ?bool,
     *   idempotencyKey?: ?string,
     *   source?: ?string,
     *   orderId?: ?string,
     *   orderDescription?: ?string,
     *   accountId?: ?string,
     *   subdomain?: ?string,
     *   subscriptionId?: ?int,
     *   autoCapture?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->allowDuplicatedBills = $values['allowDuplicatedBills'] ?? null;
        $this->doNotCreateBills = $values['doNotCreateBills'] ?? null;
        $this->forceVendorCreation = $values['forceVendorCreation'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->entryPoint = $values['entryPoint'];
        $this->source = $values['source'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->paymentMethod = $values['paymentMethod'];
        $this->paymentDetails = $values['paymentDetails'];
        $this->vendorData = $values['vendorData'];
        $this->invoiceData = $values['invoiceData'];
        $this->accountId = $values['accountId'] ?? null;
        $this->subdomain = $values['subdomain'] ?? null;
        $this->subscriptionId = $values['subscriptionId'] ?? null;
        $this->autoCapture = $values['autoCapture'] ?? null;
    }
}
