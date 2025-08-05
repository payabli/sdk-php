<?php

namespace Payabli\MoneyOut\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BillPayOutDataRequest;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\VendorPaymentMethod;

class AuthorizePayoutBody extends JsonSerializableType
{
    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var string $entryPoint
     */
    #[JsonProperty('entryPoint')]
    public string $entryPoint;

    /**
     * @var ?array<BillPayOutDataRequest> $invoiceData Array of bills associated to the transaction
     */
    #[JsonProperty('invoiceData'), ArrayType([BillPayOutDataRequest::class])]
    public ?array $invoiceData;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var RequestOutAuthorizePaymentDetails $paymentDetails Object containing payment details.
     */
    #[JsonProperty('paymentDetails')]
    public RequestOutAuthorizePaymentDetails $paymentDetails;

    /**
     * @var ?VendorPaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ?VendorPaymentMethod $paymentMethod;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

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
     * @var RequestOutAuthorizeVendorData $vendorData Object containing vendor data.
     */
    #[JsonProperty('vendorData')]
    public RequestOutAuthorizeVendorData $vendorData;

    /**
     * @param array{
     *   entryPoint: string,
     *   paymentDetails: RequestOutAuthorizePaymentDetails,
     *   vendorData: RequestOutAuthorizeVendorData,
     *   accountId?: ?string,
     *   invoiceData?: ?array<BillPayOutDataRequest>,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   paymentMethod?: ?VendorPaymentMethod,
     *   source?: ?string,
     *   subdomain?: ?string,
     *   subscriptionId?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'] ?? null;
        $this->entryPoint = $values['entryPoint'];
        $this->invoiceData = $values['invoiceData'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->paymentDetails = $values['paymentDetails'];
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->subdomain = $values['subdomain'] ?? null;
        $this->subscriptionId = $values['subscriptionId'] ?? null;
        $this->vendorData = $values['vendorData'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
