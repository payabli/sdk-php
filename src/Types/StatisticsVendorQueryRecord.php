<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class StatisticsVendorQueryRecord extends JsonSerializableType
{
    /**
     * @var string $statX The time bucket for this row, formatted according to the query's `freq` (for example, `2025-11` for a monthly bucket). Each bill falls in the bucket of its most recent update. The counts below break the vendor's bills down by bill state.
     */
    #[JsonProperty('statX')]
    public string $statX;

    /**
     * @var int $active Number of the vendor's bills in the active state (created, not yet submitted for approval).
     */
    #[JsonProperty('active')]
    public int $active;

    /**
     * @var float $activeVolume Total value of the vendor's active bills, net of fees.
     */
    #[JsonProperty('activeVolume')]
    public float $activeVolume;

    /**
     * @var int $sentToApproval Number of the vendor's bills submitted into an approval workflow.
     */
    #[JsonProperty('sentToApproval')]
    public int $sentToApproval;

    /**
     * @var float $sentToApprovalVolume Total value of the vendor's bills sent to approval, net of fees.
     */
    #[JsonProperty('sentToApprovalVolume')]
    public float $sentToApprovalVolume;

    /**
     * @var int $toApproval Number of the vendor's bills awaiting an approver's decision.
     */
    #[JsonProperty('toApproval')]
    public int $toApproval;

    /**
     * @var float $toApprovalVolume Total value of the vendor's bills awaiting approval, net of fees.
     */
    #[JsonProperty('toApprovalVolume')]
    public float $toApprovalVolume;

    /**
     * @var int $approved Number of the vendor's bills approved for payment.
     */
    #[JsonProperty('approved')]
    public int $approved;

    /**
     * @var float $approvedVolume Total value of the vendor's approved bills, net of fees.
     */
    #[JsonProperty('approvedVolume')]
    public float $approvedVolume;

    /**
     * @var int $disapproved Number of the vendor's bills rejected during approval.
     */
    #[JsonProperty('disapproved')]
    public int $disapproved;

    /**
     * @var float $disapprovedVolume Total value of the vendor's disapproved bills, net of fees.
     */
    #[JsonProperty('disapprovedVolume')]
    public float $disapprovedVolume;

    /**
     * @var int $cancelled Number of the vendor's cancelled bills.
     */
    #[JsonProperty('cancelled')]
    public int $cancelled;

    /**
     * @var float $cancelledVolume Total value of the vendor's cancelled bills, net of fees.
     */
    #[JsonProperty('cancelledVolume')]
    public float $cancelledVolume;

    /**
     * @var int $inTransit Number of the vendor's bills whose payment is in transit.
     */
    #[JsonProperty('inTransit')]
    public int $inTransit;

    /**
     * @var float $inTransitVolume Total value of the vendor's in-transit bills, net of fees.
     */
    #[JsonProperty('inTransitVolume')]
    public float $inTransitVolume;

    /**
     * @var int $paid Number of the vendor's bills marked paid. Paid means the payout has settled, not merely that Payabli issued it.
     */
    #[JsonProperty('paid')]
    public int $paid;

    /**
     * @var float $paidVolume Total value of the vendor's paid bills, net of fees.
     */
    #[JsonProperty('paidVolume')]
    public float $paidVolume;

    /**
     * @param array{
     *   statX: string,
     *   active: int,
     *   activeVolume: float,
     *   sentToApproval: int,
     *   sentToApprovalVolume: float,
     *   toApproval: int,
     *   toApprovalVolume: float,
     *   approved: int,
     *   approvedVolume: float,
     *   disapproved: int,
     *   disapprovedVolume: float,
     *   cancelled: int,
     *   cancelledVolume: float,
     *   inTransit: int,
     *   inTransitVolume: float,
     *   paid: int,
     *   paidVolume: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->statX = $values['statX'];
        $this->active = $values['active'];
        $this->activeVolume = $values['activeVolume'];
        $this->sentToApproval = $values['sentToApproval'];
        $this->sentToApprovalVolume = $values['sentToApprovalVolume'];
        $this->toApproval = $values['toApproval'];
        $this->toApprovalVolume = $values['toApprovalVolume'];
        $this->approved = $values['approved'];
        $this->approvedVolume = $values['approvedVolume'];
        $this->disapproved = $values['disapproved'];
        $this->disapprovedVolume = $values['disapprovedVolume'];
        $this->cancelled = $values['cancelled'];
        $this->cancelledVolume = $values['cancelledVolume'];
        $this->inTransit = $values['inTransit'];
        $this->inTransitVolume = $values['inTransitVolume'];
        $this->paid = $values['paid'];
        $this->paidVolume = $values['paidVolume'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
