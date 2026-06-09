<?php

namespace Payabli\Subscription\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\PayorDataRequest;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BillData;
use Payabli\Types\PaymentDetail;
use Payabli\Types\PayMethodCredit;
use Payabli\Types\PayMethodAch;
use Payabli\Types\RequestSchedulePaymentMethodInitiator;
use Payabli\Core\Types\Union;
use Payabli\Types\ScheduleDetail;
use Payabli\Types\SubscriptionType;

class RequestSchedule extends JsonSerializableType
{
    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?PayorDataRequest $customerData Object describing the customer/payor.
     */
    #[JsonProperty('customerData')]
    public ?PayorDataRequest $customerData;

    /**
     * @var ?string $entryPoint
     */
    #[JsonProperty('entryPoint')]
    public ?string $entryPoint;

    /**
     * @var ?BillData $invoiceData Object describing an Invoice linked to the subscription.
     */
    #[JsonProperty('invoiceData')]
    public ?BillData $invoiceData;

    /**
     * @var ?PaymentDetail $paymentDetails Object describing details of the payment. For Regular subscriptions, skip a payment by setting `totalAmount` to 0; payments pause until you update it to a non-zero value, and `serviceFee` must also be 0 when `totalAmount` is 0. For BalanceDriven subscriptions, any `totalAmount` you send is accepted but ignored at run time. Each run charges the payor's live balance, and a zero balance is skipped.
     */
    #[JsonProperty('paymentDetails')]
    public ?PaymentDetail $paymentDetails;

    /**
     * @var (
     *    PayMethodCredit
     *   |PayMethodAch
     *   |RequestSchedulePaymentMethodInitiator
     * )|null $paymentMethod Information about the payment method for the transaction. Required and recommended fields for each payment method type are described in each schema below.
     */
    #[JsonProperty('paymentMethod'), Union(PayMethodCredit::class, PayMethodAch::class, RequestSchedulePaymentMethodInitiator::class, 'null')]
    public PayMethodCredit|PayMethodAch|RequestSchedulePaymentMethodInitiator|null $paymentMethod;

    /**
     * @var ?ScheduleDetail $scheduleDetails Object describing the schedule for subscription.
     */
    #[JsonProperty('scheduleDetails')]
    public ?ScheduleDetail $scheduleDetails;

    /**
     * @var ?bool $setPause
     */
    #[JsonProperty('setPause')]
    public ?bool $setPause;

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
     * @var ?value-of<SubscriptionType> $subscriptionType Subscription type. Defaults to `Regular` when omitted. Can't be changed after the subscription is created. If you send it to the update endpoint, it's ignored.
     */
    #[JsonProperty('subscriptionType')]
    public ?string $subscriptionType;

    /**
     * @param array{
     *   forceCustomerCreation?: ?bool,
     *   idempotencyKey?: ?string,
     *   customerData?: ?PayorDataRequest,
     *   entryPoint?: ?string,
     *   invoiceData?: ?BillData,
     *   paymentDetails?: ?PaymentDetail,
     *   paymentMethod?: (
     *    PayMethodCredit
     *   |PayMethodAch
     *   |RequestSchedulePaymentMethodInitiator
     * )|null,
     *   scheduleDetails?: ?ScheduleDetail,
     *   setPause?: ?bool,
     *   source?: ?string,
     *   subdomain?: ?string,
     *   subscriptionType?: ?value-of<SubscriptionType>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->customerData = $values['customerData'] ?? null;
        $this->entryPoint = $values['entryPoint'] ?? null;
        $this->invoiceData = $values['invoiceData'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->scheduleDetails = $values['scheduleDetails'] ?? null;
        $this->setPause = $values['setPause'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->subdomain = $values['subdomain'] ?? null;
        $this->subscriptionType = $values['subscriptionType'] ?? null;
    }
}
