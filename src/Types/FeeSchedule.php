<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A fee schedule attached to a billable event. Flat and interchange-plus
 * schedules share this shape; `feeType` is the discriminator.
 */
class FeeSchedule extends JsonSerializableType
{
    /**
     * @var int $id Fee schedule identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var float $value The flat-fee component of the fee, for example `0.30`.
     */
    #[JsonProperty('value')]
    public float $value;

    /**
     * @var float $rate The percentage-rate component of the fee, for example `2.9`.
     */
    #[JsonProperty('rate')]
    public float $rate;

    /**
     * @var int $passthrough
     */
    #[JsonProperty('passthrough')]
    public int $passthrough;

    /**
     * @var ?BillingEntity $payor Entity responsible for paying this fee. `null` when not set.
     */
    #[JsonProperty('payor')]
    public ?BillingEntity $payor;

    /**
     * @var ?BillingEntity $collector Entity that collects this fee. `null` when not set.
     */
    #[JsonProperty('collector')]
    public ?BillingEntity $collector;

    /**
     * Fallback payor used when the primary payor can't cover the fee. `null`
     * when not set.
     *
     * @var ?BillingEntity $overflowPayor
     */
    #[JsonProperty('overflowPayor')]
    public ?BillingEntity $overflowPayor;

    /**
     * @var ?int $overflowCollectionSchedule Collection cadence for the overflow payor. `null` when not set.
     */
    #[JsonProperty('overflowCollectionSchedule')]
    public ?int $overflowCollectionSchedule;

    /**
     * @var ?float $minimumTotal Floor on the combined fee (rate + flat value) for this schedule.
     */
    #[JsonProperty('minimumTotal')]
    public ?float $minimumTotal;

    /**
     * @var ?float $maximumTotal Ceiling on the combined fee (rate + flat value) for this schedule.
     */
    #[JsonProperty('maximumTotal')]
    public ?float $maximumTotal;

    /**
     * When this schedule starts applying. Drives ordering when an event has
     * multiple schedules.
     *
     * @var DateTime $effectiveDate
     */
    #[JsonProperty('effectiveDate'), Date(Date::TYPE_DATETIME)]
    public DateTime $effectiveDate;

    /**
     * @var ?DateTime $expirationDate When this schedule stops applying. `null` means no end date.
     */
    #[JsonProperty('expirationDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $expirationDate;

    /**
     * @var DateTime $createdAt When this schedule was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $updatedAt When this schedule was last updated.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * Identifier of the schedule's creator. Surfaces in the Payabli Portal as
     * "Configuration Owner" — informational, not a permission boundary.
     *
     * @var string $createdBy
     */
    #[JsonProperty('createdBy')]
    public string $createdBy;

    /**
     * @var int $collectionSchedule
     */
    #[JsonProperty('collectionSchedule')]
    public int $collectionSchedule;

    /**
     * @var ?int $billDate Day of the month a monthly bill is applied, when set. `null` otherwise.
     */
    #[JsonProperty('billDate')]
    public ?int $billDate;

    /**
     * @var ?int $overrideFeeScheduleId Identifier of another fee schedule this one overrides. `null` otherwise.
     */
    #[JsonProperty('overrideFeeScheduleId')]
    public ?int $overrideFeeScheduleId;

    /**
     * @var int $feeType
     */
    #[JsonProperty('feeType')]
    public int $feeType;

    /**
     * @param array{
     *   id: int,
     *   value: float,
     *   rate: float,
     *   passthrough: int,
     *   effectiveDate: DateTime,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   createdBy: string,
     *   collectionSchedule: int,
     *   feeType: int,
     *   payor?: ?BillingEntity,
     *   collector?: ?BillingEntity,
     *   overflowPayor?: ?BillingEntity,
     *   overflowCollectionSchedule?: ?int,
     *   minimumTotal?: ?float,
     *   maximumTotal?: ?float,
     *   expirationDate?: ?DateTime,
     *   billDate?: ?int,
     *   overrideFeeScheduleId?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->value = $values['value'];
        $this->rate = $values['rate'];
        $this->passthrough = $values['passthrough'];
        $this->payor = $values['payor'] ?? null;
        $this->collector = $values['collector'] ?? null;
        $this->overflowPayor = $values['overflowPayor'] ?? null;
        $this->overflowCollectionSchedule = $values['overflowCollectionSchedule'] ?? null;
        $this->minimumTotal = $values['minimumTotal'] ?? null;
        $this->maximumTotal = $values['maximumTotal'] ?? null;
        $this->effectiveDate = $values['effectiveDate'];
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->createdBy = $values['createdBy'];
        $this->collectionSchedule = $values['collectionSchedule'];
        $this->billDate = $values['billDate'] ?? null;
        $this->overrideFeeScheduleId = $values['overrideFeeScheduleId'] ?? null;
        $this->feeType = $values['feeType'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
