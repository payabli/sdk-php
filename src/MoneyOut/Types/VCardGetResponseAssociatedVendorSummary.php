<?php

namespace Payabli\MoneyOut\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Summary of vendor's billing and transaction status.
 */
class VCardGetResponseAssociatedVendorSummary extends JsonSerializableType
{
    /**
     * @var ?int $activeBills Number of active bills.
     */
    #[JsonProperty('ActiveBills')]
    public ?int $activeBills;

    /**
     * @var ?float $activeBillsAmount Total amount of active bills.
     */
    #[JsonProperty('ActiveBillsAmount')]
    public ?float $activeBillsAmount;

    /**
     * @var ?int $approvedBills Number of bills that have been approved.
     */
    #[JsonProperty('ApprovedBills')]
    public ?int $approvedBills;

    /**
     * @var ?float $approvedBillsAmount Total amount of approved bills.
     */
    #[JsonProperty('ApprovedBillsAmount')]
    public ?float $approvedBillsAmount;

    /**
     * @var ?int $disapprovedBills Number of bills that have been disapproved.
     */
    #[JsonProperty('DisapprovedBills')]
    public ?int $disapprovedBills;

    /**
     * @var ?float $disapprovedBillsAmount Total amount of rejected bills.
     */
    #[JsonProperty('DisapprovedBillsAmount')]
    public ?float $disapprovedBillsAmount;

    /**
     * @var ?int $inTransitBills Number of bills in transit.
     */
    #[JsonProperty('InTransitBills')]
    public ?int $inTransitBills;

    /**
     * @var ?float $inTransitBillsAmount Total amount of bills in transit.
     */
    #[JsonProperty('InTransitBillsAmount')]
    public ?float $inTransitBillsAmount;

    /**
     * @var ?int $overdueBills Number of bills that are overdue.
     */
    #[JsonProperty('OverdueBills')]
    public ?int $overdueBills;

    /**
     * @var ?float $overdueBillsAmount Total amount of overdue bills.
     */
    #[JsonProperty('OverdueBillsAmount')]
    public ?float $overdueBillsAmount;

    /**
     * @var ?int $paidBills Number of bills that have been paid.
     */
    #[JsonProperty('PaidBills')]
    public ?int $paidBills;

    /**
     * @var ?float $paidBillsAmount Total amount of paid bills.
     */
    #[JsonProperty('PaidBillsAmount')]
    public ?float $paidBillsAmount;

    /**
     * @var ?int $pendingBills Number of bills pending approval or payment.
     */
    #[JsonProperty('PendingBills')]
    public ?int $pendingBills;

    /**
     * @var ?float $pendingBillsAmount Total amount of pending bills.
     */
    #[JsonProperty('PendingBillsAmount')]
    public ?float $pendingBillsAmount;

    /**
     * @var ?int $totalBills Total number of bills.
     */
    #[JsonProperty('TotalBills')]
    public ?int $totalBills;

    /**
     * @var ?float $totalBillsAmount Total amount of all bills.
     */
    #[JsonProperty('TotalBillsAmount')]
    public ?float $totalBillsAmount;

    /**
     * @param array{
     *   activeBills?: ?int,
     *   activeBillsAmount?: ?float,
     *   approvedBills?: ?int,
     *   approvedBillsAmount?: ?float,
     *   disapprovedBills?: ?int,
     *   disapprovedBillsAmount?: ?float,
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
        $this->activeBills = $values['activeBills'] ?? null;
        $this->activeBillsAmount = $values['activeBillsAmount'] ?? null;
        $this->approvedBills = $values['approvedBills'] ?? null;
        $this->approvedBillsAmount = $values['approvedBillsAmount'] ?? null;
        $this->disapprovedBills = $values['disapprovedBills'] ?? null;
        $this->disapprovedBillsAmount = $values['disapprovedBillsAmount'] ?? null;
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
