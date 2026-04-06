<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\MoneyOutTypes\Types\AuthorizePaymentMethod;
use Payabli\MoneyOutTypes\Types\RequestOutAuthorizeVendorData;
use Payabli\Types\BillPayOutDataRequest;
use Payabli\Core\Types\ArrayType;

class PayoutSubscriptionRequestBody extends JsonSerializableType
{
    /**
     * @var string $entryPoint
     */
    #[JsonProperty('entryPoint')]
    public string $entryPoint;

    /**
     * @var ?string $subdomain
     */
    #[JsonProperty('subdomain')]
    public ?string $subdomain;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?bool $setPause
     */
    #[JsonProperty('setPause')]
    public ?bool $setPause;

    /**
     * @var AuthorizePaymentMethod $paymentMethod Payment method for the payout subscription. Supports `ach`, `vcard`, and `check`. The `managed` method isn't supported for payout subscriptions.
     */
    #[JsonProperty('paymentMethod')]
    public AuthorizePaymentMethod $paymentMethod;

    /**
     * @var ?PayoutPaymentDetail $paymentDetails Object describing details of the payout.
     */
    #[JsonProperty('paymentDetails')]
    public ?PayoutPaymentDetail $paymentDetails;

    /**
     * @var RequestOutAuthorizeVendorData $vendorData Object identifying the vendor for this subscription. Only a `vendorId` or `vendorNumber` is needed to link to an existing vendor.
     */
    #[JsonProperty('vendorData')]
    public RequestOutAuthorizeVendorData $vendorData;

    /**
     * @var ?array<BillPayOutDataRequest> $billData Array of bills associated with the payout subscription. If omitted and `doNotCreateBills` isn't set to `true`, the system creates a bill automatically.
     */
    #[JsonProperty('billData'), ArrayType([BillPayOutDataRequest::class])]
    public ?array $billData;

    /**
     * @var ?PayoutScheduleDetail $scheduleDetails Object describing the schedule for the payout subscription.
     */
    #[JsonProperty('scheduleDetails')]
    public ?PayoutScheduleDetail $scheduleDetails;

    /**
     * @param array{
     *   entryPoint: string,
     *   paymentMethod: AuthorizePaymentMethod,
     *   vendorData: RequestOutAuthorizeVendorData,
     *   subdomain?: ?string,
     *   accountId?: ?string,
     *   source?: ?string,
     *   setPause?: ?bool,
     *   paymentDetails?: ?PayoutPaymentDetail,
     *   billData?: ?array<BillPayOutDataRequest>,
     *   scheduleDetails?: ?PayoutScheduleDetail,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->entryPoint = $values['entryPoint'];
        $this->subdomain = $values['subdomain'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->setPause = $values['setPause'] ?? null;
        $this->paymentMethod = $values['paymentMethod'];
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->vendorData = $values['vendorData'];
        $this->billData = $values['billData'] ?? null;
        $this->scheduleDetails = $values['scheduleDetails'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
