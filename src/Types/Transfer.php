<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class Transfer extends JsonSerializableType
{
    /**
     * @var int $transferId The transfer ID.
     */
    #[JsonProperty('transferId')]
    public int $transferId;

    /**
     * @var int $paypointId The ID of the paypoint the transfer belongs to.
     */
    #[JsonProperty('paypointId')]
    public int $paypointId;

    /**
     * @var string $batchNumber The batch number associated with the transfer.
     */
    #[JsonProperty('batchNumber')]
    public string $batchNumber;

    /**
     * @var string $transferIdentifier Unique identifier for the transfer.
     */
    #[JsonProperty('transferIdentifier')]
    public string $transferIdentifier;

    /**
     * @var int $batchId The ID of the batch the transfer belongs to.
     */
    #[JsonProperty('batchId')]
    public int $batchId;

    /**
     * @var string $transferDate Date when the transfer occurred.
     */
    #[JsonProperty('transferDate')]
    public string $transferDate;

    /**
     * @var string $processor The payment processor used for the transfer.
     */
    #[JsonProperty('processor')]
    public string $processor;

    /**
     * @var int $transferStatus The current status of the transfer.
     */
    #[JsonProperty('transferStatus')]
    public int $transferStatus;

    /**
     * @var float $grossAmount Gross batch is the total amount of the payments grouped in the batch. This amount includes service fees.
     */
    #[JsonProperty('grossAmount')]
    public float $grossAmount;

    /**
     * @var float $chargeBackAmount Amount of chargebacks to be deducted from batch.
     */
    #[JsonProperty('chargeBackAmount')]
    public float $chargeBackAmount;

    /**
     * @var float $returnedAmount Amount of ACH returns to be deducted from batch.
     */
    #[JsonProperty('returnedAmount')]
    public float $returnedAmount;

    /**
     * @var float $holdAmount Amount being held for fraud or risk concerns.
     */
    #[JsonProperty('holdAmount')]
    public float $holdAmount;

    /**
     * @var float $releasedAmount Amount of previously held funds that have been released after a risk review.
     */
    #[JsonProperty('releasedAmount')]
    public float $releasedAmount;

    /**
     * @var float $billingFeesAmount Amount of charges and fees applied for services and transactions.
     */
    #[JsonProperty('billingFeesAmount')]
    public float $billingFeesAmount;

    /**
     * @var float $thirdPartyPaidAmount Amount of payments captured in the batch cycle that are deposited separately. For example, checks or cash payments recorded in the batch but not deposited via Payabli, or card brands making a direct transfer in certain situations.
     */
    #[JsonProperty('thirdPartyPaidAmount')]
    public float $thirdPartyPaidAmount;

    /**
     * @var float $adjustmentsAmount Amount of corrections applied to Billing & Fees charges.
     */
    #[JsonProperty('adjustmentsAmount')]
    public float $adjustmentsAmount;

    /**
     * @var float $netTransferAmount The net transfer amount after all deductions and additions.
     */
    #[JsonProperty('netTransferAmount')]
    public float $netTransferAmount;

    /**
     * @var array<TransferEvent> $eventsData List of events associated with the transfer.
     */
    #[JsonProperty('eventsData'), ArrayType([TransferEvent::class])]
    public array $eventsData;

    /**
     * @var array<string> $messages List of messages related to the transfer.
     */
    #[JsonProperty('messages'), ArrayType(['string'])]
    public array $messages;

    /**
     * @param array{
     *   transferId: int,
     *   paypointId: int,
     *   batchNumber: string,
     *   transferIdentifier: string,
     *   batchId: int,
     *   transferDate: string,
     *   processor: string,
     *   transferStatus: int,
     *   grossAmount: float,
     *   chargeBackAmount: float,
     *   returnedAmount: float,
     *   holdAmount: float,
     *   releasedAmount: float,
     *   billingFeesAmount: float,
     *   thirdPartyPaidAmount: float,
     *   adjustmentsAmount: float,
     *   netTransferAmount: float,
     *   eventsData: array<TransferEvent>,
     *   messages: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transferId = $values['transferId'];
        $this->paypointId = $values['paypointId'];
        $this->batchNumber = $values['batchNumber'];
        $this->transferIdentifier = $values['transferIdentifier'];
        $this->batchId = $values['batchId'];
        $this->transferDate = $values['transferDate'];
        $this->processor = $values['processor'];
        $this->transferStatus = $values['transferStatus'];
        $this->grossAmount = $values['grossAmount'];
        $this->chargeBackAmount = $values['chargeBackAmount'];
        $this->returnedAmount = $values['returnedAmount'];
        $this->holdAmount = $values['holdAmount'];
        $this->releasedAmount = $values['releasedAmount'];
        $this->billingFeesAmount = $values['billingFeesAmount'];
        $this->thirdPartyPaidAmount = $values['thirdPartyPaidAmount'];
        $this->adjustmentsAmount = $values['adjustmentsAmount'];
        $this->netTransferAmount = $values['netTransferAmount'];
        $this->eventsData = $values['eventsData'];
        $this->messages = $values['messages'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
