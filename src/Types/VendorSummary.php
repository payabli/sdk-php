<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class VendorSummary extends JsonSerializableType
{
    /**
     * @var ?int $inTransitBills
     */
    #[JsonProperty('inTransitBills')]
    public ?int $inTransitBills;

    /**
     * @var ?float $inTransitBillsAmount
     */
    #[JsonProperty('inTransitBillsAmount')]
    public ?float $inTransitBillsAmount;

    /**
     * @var ?int $overdueBills
     */
    #[JsonProperty('overdueBills')]
    public ?int $overdueBills;

    /**
     * @var ?float $overdueBillsAmount
     */
    #[JsonProperty('overdueBillsAmount')]
    public ?float $overdueBillsAmount;

    /**
     * @var ?int $paidBills
     */
    #[JsonProperty('paidBills')]
    public ?int $paidBills;

    /**
     * @var ?float $paidBillsAmount
     */
    #[JsonProperty('paidBillsAmount')]
    public ?float $paidBillsAmount;

    /**
     * @var ?int $pendingBills
     */
    #[JsonProperty('pendingBills')]
    public ?int $pendingBills;

    /**
     * @var ?float $pendingBillsAmount
     */
    #[JsonProperty('pendingBillsAmount')]
    public ?float $pendingBillsAmount;

    /**
     * @var ?int $totalBills
     */
    #[JsonProperty('totalBills')]
    public ?int $totalBills;

    /**
     * @var ?float $totalBillsAmount
     */
    #[JsonProperty('totalBillsAmount')]
    public ?float $totalBillsAmount;

    /**
     * @param array{
     *   inTransitBills?: ?int,
     *   inTransitBillsAmount?: ?float,
     *   overdueBills?: ?int,
     *   overdueBillsAmount?: ?float,
     *   paidBills?: ?int,
     *   paidBillsAmount?: ?float,
     *   pendingBills?: ?int,
     *   pendingBillsAmount?: ?float,
     *   totalBills?: ?int,
     *   totalBillsAmount?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->inTransitBills = $values['inTransitBills'] ?? null;
        $this->inTransitBillsAmount = $values['inTransitBillsAmount'] ?? null;
        $this->overdueBills = $values['overdueBills'] ?? null;
        $this->overdueBillsAmount = $values['overdueBillsAmount'] ?? null;
        $this->paidBills = $values['paidBills'] ?? null;
        $this->paidBillsAmount = $values['paidBillsAmount'] ?? null;
        $this->pendingBills = $values['pendingBills'] ?? null;
        $this->pendingBillsAmount = $values['pendingBillsAmount'] ?? null;
        $this->totalBills = $values['totalBills'] ?? null;
        $this->totalBillsAmount = $values['totalBillsAmount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
