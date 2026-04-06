<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\MoneyOutTypes\Types\AuthorizePaymentMethod;

class UpdatePayoutSubscriptionBody extends JsonSerializableType
{
    /**
     * @var ?bool $setPause
     */
    #[JsonProperty('setPause')]
    public ?bool $setPause;

    /**
     * @var ?PayoutPaymentDetail $paymentDetails Object describing details of the payout.
     */
    #[JsonProperty('paymentDetails')]
    public ?PayoutPaymentDetail $paymentDetails;

    /**
     * @var ?AuthorizePaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ?AuthorizePaymentMethod $paymentMethod;

    /**
     * @var ?PayoutScheduleDetail $scheduleDetails Object describing the schedule for the payout subscription.
     */
    #[JsonProperty('scheduleDetails')]
    public ?PayoutScheduleDetail $scheduleDetails;

    /**
     * @param array{
     *   setPause?: ?bool,
     *   paymentDetails?: ?PayoutPaymentDetail,
     *   paymentMethod?: ?AuthorizePaymentMethod,
     *   scheduleDetails?: ?PayoutScheduleDetail,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->setPause = $values['setPause'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
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
