<?php

namespace Payabli\Subscription\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\BillData;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PaymentDetail;
use Payabli\Types\ScheduleDetail;

class RequestUpdateSchedule extends JsonSerializableType
{
    /**
     * @var ?BillData $invoiceData Object describing an invoice linked to the subscription. Replaces the subscription's existing invoice data entirely. Send `null` to remove it, or leave it out to keep the current invoice data. See [Update a subscription](/guides/pay-in-developer-subscriptions-manage#update-a-subscription) for details.
     */
    #[JsonProperty('invoiceData')]
    public ?BillData $invoiceData;

    /**
     * @var ?PaymentDetail $paymentDetails Object describing details of the payment. For Regular subscriptions, skip a payment by setting `totalAmount` to 0; payments pause until you update it to a non-zero value, and `serviceFee` must also be 0 when `totalAmount` is 0. For BalanceDriven subscriptions, any `totalAmount` you send is accepted but ignored at run time. Each run charges the payor's live balance, and a zero balance is skipped.
     */
    #[JsonProperty('paymentDetails')]
    public ?PaymentDetail $paymentDetails;

    /**
     * @var ?ScheduleDetail $scheduleDetails Object describing the schedule for subscription
     */
    #[JsonProperty('scheduleDetails')]
    public ?ScheduleDetail $scheduleDetails;

    /**
     * @var ?bool $setPause
     */
    #[JsonProperty('setPause')]
    public ?bool $setPause;

    /**
     * @param array{
     *   invoiceData?: ?BillData,
     *   paymentDetails?: ?PaymentDetail,
     *   scheduleDetails?: ?ScheduleDetail,
     *   setPause?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->invoiceData = $values['invoiceData'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->scheduleDetails = $values['scheduleDetails'] ?? null;
        $this->setPause = $values['setPause'] ?? null;
    }
}
