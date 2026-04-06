<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\GeneralEvents;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\VendorQueryRecord;
use Payabli\Types\BillPayOutData;
use Payabli\Types\QueryPaymentData;
use DateTime;
use Payabli\Core\Types\Date;

class PayoutSubscriptionQueryRecord extends JsonSerializableType
{
    /**
     * @var ?int $idOutSubscription The payout subscription's ID.
     */
    #[JsonProperty('idOutSubscription')]
    public ?int $idOutSubscription;

    /**
     * The payout subscription's status.
     * - 0: Paused
     * - 1: Active
     *
     * @var ?int $status
     */
    #[JsonProperty('status')]
    public ?int $status;

    /**
     * @var ?array<GeneralEvents> $events Events associated with the payout subscription.
     */
    #[JsonProperty('events'), ArrayType([GeneralEvents::class])]
    public ?array $events;

    /**
     * @var ?VendorQueryRecord $vendor
     */
    #[JsonProperty('vendor')]
    public ?VendorQueryRecord $vendor;

    /**
     * @var ?array<BillPayOutData> $billData Bills associated with the payout subscription.
     */
    #[JsonProperty('billData'), ArrayType([BillPayOutData::class])]
    public ?array $billData;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $method The payout subscription's payment method.
     */
    #[JsonProperty('method')]
    public ?string $method;

    /**
     * @var ?int $paypointId
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var ?float $totalAmount The payout subscription amount, including any fees.
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $netAmount The payout subscription amount, minus any fees.
     */
    #[JsonProperty('netAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $feeAmount Fee applied to the payout subscription.
     */
    #[JsonProperty('feeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?QueryPaymentData $paymentData
     */
    #[JsonProperty('paymentData')]
    public ?QueryPaymentData $paymentData;

    /**
     * @var ?DateTime $startDate The payout subscription start date.
     */
    #[JsonProperty('startDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $startDate;

    /**
     * @var ?DateTime $endDate The payout subscription's end date.
     */
    #[JsonProperty('endDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $endDate;

    /**
     * @var ?DateTime $nextDate The next date the payout subscription will be processed.
     */
    #[JsonProperty('nextDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $nextDate;

    /**
     * @var ?string $frequency The payout subscription's frequency.
     */
    #[JsonProperty('frequency')]
    public ?string $frequency;

    /**
     * @var ?int $totalCycles The total number of cycles the payout subscription is set to run.
     */
    #[JsonProperty('totalCycles')]
    public ?int $totalCycles;

    /**
     * @var ?int $leftCycles The number of cycles the payout subscription has left.
     */
    #[JsonProperty('leftCycles')]
    public ?int $leftCycles;

    /**
     * @var ?DateTime $lastRun The last time the payout subscription was processed.
     */
    #[JsonProperty('lastRun'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastRun;

    /**
     * @var ?int $entrypageId
     */
    #[JsonProperty('entrypageId')]
    public ?int $entrypageId;

    /**
     * @var ?bool $untilCancelled When `true`, the payout subscription has no explicit end date and runs until canceled.
     */
    #[JsonProperty('untilCancelled')]
    public ?bool $untilCancelled;

    /**
     * @var ?DateTime $lastUpdated The last date and time the payout subscription was updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?DateTime $createdAt Timestamp of when the payout subscription was created, in UTC.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?string $paypointLegalname The paypoint's legal name.
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $paypointDbaname The paypoint's DBA name.
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname The paypoint's entryname.
     */
    #[JsonProperty('paypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId
     */
    #[JsonProperty('parentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @param array{
     *   idOutSubscription?: ?int,
     *   status?: ?int,
     *   events?: ?array<GeneralEvents>,
     *   vendor?: ?VendorQueryRecord,
     *   billData?: ?array<BillPayOutData>,
     *   externalPaypointId?: ?string,
     *   method?: ?string,
     *   paypointId?: ?int,
     *   totalAmount?: ?float,
     *   netAmount?: ?float,
     *   feeAmount?: ?float,
     *   paymentData?: ?QueryPaymentData,
     *   startDate?: ?DateTime,
     *   endDate?: ?DateTime,
     *   nextDate?: ?DateTime,
     *   frequency?: ?string,
     *   totalCycles?: ?int,
     *   leftCycles?: ?int,
     *   lastRun?: ?DateTime,
     *   entrypageId?: ?int,
     *   untilCancelled?: ?bool,
     *   lastUpdated?: ?DateTime,
     *   createdAt?: ?DateTime,
     *   paypointLegalname?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   parentOrgName?: ?string,
     *   parentOrgId?: ?int,
     *   source?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->idOutSubscription = $values['idOutSubscription'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->events = $values['events'] ?? null;
        $this->vendor = $values['vendor'] ?? null;
        $this->billData = $values['billData'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->feeAmount = $values['feeAmount'] ?? null;
        $this->paymentData = $values['paymentData'] ?? null;
        $this->startDate = $values['startDate'] ?? null;
        $this->endDate = $values['endDate'] ?? null;
        $this->nextDate = $values['nextDate'] ?? null;
        $this->frequency = $values['frequency'] ?? null;
        $this->totalCycles = $values['totalCycles'] ?? null;
        $this->leftCycles = $values['leftCycles'] ?? null;
        $this->lastRun = $values['lastRun'] ?? null;
        $this->entrypageId = $values['entrypageId'] ?? null;
        $this->untilCancelled = $values['untilCancelled'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->source = $values['source'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
