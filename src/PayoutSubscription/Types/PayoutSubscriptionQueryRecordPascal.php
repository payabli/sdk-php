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

class PayoutSubscriptionQueryRecordPascal extends JsonSerializableType
{
    /**
     * @var ?int $idOutSubscription The payout subscription's ID.
     */
    #[JsonProperty('IdOutSubscription')]
    public ?int $idOutSubscription;

    /**
     * The payout subscription's status.
     * - 0: Paused
     * - 1: Active
     *
     * @var ?int $status
     */
    #[JsonProperty('Status')]
    public ?int $status;

    /**
     * @var ?array<GeneralEvents> $events Events associated with the payout subscription.
     */
    #[JsonProperty('Events'), ArrayType([GeneralEvents::class])]
    public ?array $events;

    /**
     * @var ?VendorQueryRecord $vendor
     */
    #[JsonProperty('Vendor')]
    public ?VendorQueryRecord $vendor;

    /**
     * @var ?array<BillPayOutData> $billData Bills associated with the payout subscription.
     */
    #[JsonProperty('BillData'), ArrayType([BillPayOutData::class])]
    public ?array $billData;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('ExternalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $method The payout subscription's payment method.
     */
    #[JsonProperty('Method')]
    public ?string $method;

    /**
     * @var ?int $paypointId
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?float $totalAmount The payout subscription amount, including any fees.
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $netAmount The payout subscription amount, minus any fees.
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $feeAmount Fee applied to the payout subscription.
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?QueryPaymentData $paymentData
     */
    #[JsonProperty('PaymentData')]
    public ?QueryPaymentData $paymentData;

    /**
     * @var ?DateTime $startDate The payout subscription start date.
     */
    #[JsonProperty('StartDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $startDate;

    /**
     * @var ?DateTime $endDate The payout subscription's end date.
     */
    #[JsonProperty('EndDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $endDate;

    /**
     * @var ?DateTime $nextDate The next date the payout subscription will be processed.
     */
    #[JsonProperty('NextDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $nextDate;

    /**
     * @var ?string $frequency The payout subscription's frequency.
     */
    #[JsonProperty('Frequency')]
    public ?string $frequency;

    /**
     * @var ?int $totalCycles The total number of cycles the payout subscription is set to run.
     */
    #[JsonProperty('TotalCycles')]
    public ?int $totalCycles;

    /**
     * @var ?int $leftCycles The number of cycles the payout subscription has left.
     */
    #[JsonProperty('LeftCycles')]
    public ?int $leftCycles;

    /**
     * @var ?DateTime $lastRun The last time the payout subscription was processed.
     */
    #[JsonProperty('LastRun'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastRun;

    /**
     * @var ?int $entrypageId
     */
    #[JsonProperty('EntrypageId')]
    public ?int $entrypageId;

    /**
     * @var ?bool $untilCancelled When `true`, the payout subscription has no explicit end date and runs until canceled.
     */
    #[JsonProperty('UntilCancelled')]
    public ?bool $untilCancelled;

    /**
     * @var ?DateTime $lastUpdated The last date and time the payout subscription was updated.
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?DateTime $createdAt Timestamp of when the payout subscription was created, in UTC.
     */
    #[JsonProperty('CreatedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?string $paypointLegalname The paypoint's legal name.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $paypointDbaname The paypoint's DBA name.
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname The paypoint's entryname.
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $source
     */
    #[JsonProperty('Source')]
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
