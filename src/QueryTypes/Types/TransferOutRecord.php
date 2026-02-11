<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

/**
 * A record representing an outbound transfer.
 */
class TransferOutRecord extends JsonSerializableType
{
    /**
     * @var ?int $transferId Unique identifier for the transfer.
     */
    #[JsonProperty('transferId')]
    public ?int $transferId;

    /**
     * @var ?int $paypointId The ID of the paypoint associated with the transfer.
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $batchNumber The batch number for the transfer.
     */
    #[JsonProperty('batchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?string $batchCurrency The currency of the batch.
     */
    #[JsonProperty('batchCurrency')]
    public ?string $batchCurrency;

    /**
     * @var ?int $batchRecords The number of records in the batch.
     */
    #[JsonProperty('batchRecords')]
    public ?int $batchRecords;

    /**
     * @var ?string $transferIdentifier An identifier for the transfer.
     */
    #[JsonProperty('transferIdentifier')]
    public ?string $transferIdentifier;

    /**
     * @var ?int $batchId The ID of the batch.
     */
    #[JsonProperty('batchId')]
    public ?int $batchId;

    /**
     * @var ?float $batchNetAmount The net amount of the batch.
     */
    #[JsonProperty('batchNetAmount')]
    public ?float $batchNetAmount;

    /**
     * @var ?int $batchStatus The status of the batch.
     */
    #[JsonProperty('batchStatus')]
    public ?int $batchStatus;

    /**
     * @var ?string $paypointEntryName The entry name for the paypoint.
     */
    #[JsonProperty('paypointEntryName')]
    public ?string $paypointEntryName;

    /**
     * @var ?string $paypointLegalName The legal name of the paypoint.
     */
    #[JsonProperty('paypointLegalName')]
    public ?string $paypointLegalName;

    /**
     * @var ?string $paypointDbaName The DBA name of the paypoint.
     */
    #[JsonProperty('paypointDbaName')]
    public ?string $paypointDbaName;

    /**
     * @var ?string $paypointLogo URL to the paypoint's logo.
     */
    #[JsonProperty('paypointLogo')]
    public ?string $paypointLogo;

    /**
     * @var ?string $parentOrgName The name of the parent organization.
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId The ID of the parent organization.
     */
    #[JsonProperty('parentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $parentOrgLogo URL to the parent organization's logo.
     */
    #[JsonProperty('parentOrgLogo')]
    public ?string $parentOrgLogo;

    /**
     * @var ?string $parentOrgEntryName The entry name for the parent organization.
     */
    #[JsonProperty('parentOrgEntryName')]
    public ?string $parentOrgEntryName;

    /**
     * @var ?string $externalPaypointId External identifier for the paypoint.
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?TransferOutBankAccount $bankAccount Bank account information for the transfer.
     */
    #[JsonProperty('bankAccount')]
    public ?TransferOutBankAccount $bankAccount;

    /**
     * @var ?DateTime $transferDate The date of the transfer.
     */
    #[JsonProperty('transferDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $transferDate;

    /**
     * @var ?string $processor The processor used for the transfer.
     */
    #[JsonProperty('processor')]
    public ?string $processor;

    /**
     * @var ?int $transferStatus The status of the transfer.
     */
    #[JsonProperty('transferStatus')]
    public ?int $transferStatus;

    /**
     * @var ?float $grossAmount The gross amount of the transfer.
     */
    #[JsonProperty('grossAmount')]
    public ?float $grossAmount;

    /**
     * @var ?float $chargeBackAmount The chargeback amount deducted from the transfer.
     */
    #[JsonProperty('chargeBackAmount')]
    public ?float $chargeBackAmount;

    /**
     * @var ?float $returnedAmount The returned amount deducted from the transfer.
     */
    #[JsonProperty('returnedAmount')]
    public ?float $returnedAmount;

    /**
     * @var ?float $holdAmount The amount being held.
     */
    #[JsonProperty('holdAmount')]
    public ?float $holdAmount;

    /**
     * @var ?float $releasedAmount The amount that has been released.
     */
    #[JsonProperty('releasedAmount')]
    public ?float $releasedAmount;

    /**
     * @var ?float $billingFeesAmount The billing fees amount.
     */
    #[JsonProperty('billingFeesAmount')]
    public ?float $billingFeesAmount;

    /**
     * @var ?float $thirdPartyPaidAmount The third party paid amount.
     */
    #[JsonProperty('thirdPartyPaidAmount')]
    public ?float $thirdPartyPaidAmount;

    /**
     * @var ?float $adjustmentsAmount The adjustments amount.
     */
    #[JsonProperty('adjustmentsAmount')]
    public ?float $adjustmentsAmount;

    /**
     * @var ?float $netTransferAmount The net transfer amount after all deductions.
     */
    #[JsonProperty('netTransferAmount')]
    public ?float $netTransferAmount;

    /**
     * @var ?float $splitAmount The split funding amount.
     */
    #[JsonProperty('splitAmount')]
    public ?float $splitAmount;

    /**
     * @var ?array<TransferOutEventData> $eventsData List of events associated with the transfer.
     */
    #[JsonProperty('eventsData'), ArrayType([TransferOutEventData::class])]
    public ?array $eventsData;

    /**
     * @var ?array<TransferOutMessage> $messages List of messages associated with the transfer.
     */
    #[JsonProperty('messages'), ArrayType([TransferOutMessage::class])]
    public ?array $messages;

    /**
     * @param array{
     *   transferId?: ?int,
     *   paypointId?: ?int,
     *   batchNumber?: ?string,
     *   batchCurrency?: ?string,
     *   batchRecords?: ?int,
     *   transferIdentifier?: ?string,
     *   batchId?: ?int,
     *   batchNetAmount?: ?float,
     *   batchStatus?: ?int,
     *   paypointEntryName?: ?string,
     *   paypointLegalName?: ?string,
     *   paypointDbaName?: ?string,
     *   paypointLogo?: ?string,
     *   parentOrgName?: ?string,
     *   parentOrgId?: ?int,
     *   parentOrgLogo?: ?string,
     *   parentOrgEntryName?: ?string,
     *   externalPaypointId?: ?string,
     *   bankAccount?: ?TransferOutBankAccount,
     *   transferDate?: ?DateTime,
     *   processor?: ?string,
     *   transferStatus?: ?int,
     *   grossAmount?: ?float,
     *   chargeBackAmount?: ?float,
     *   returnedAmount?: ?float,
     *   holdAmount?: ?float,
     *   releasedAmount?: ?float,
     *   billingFeesAmount?: ?float,
     *   thirdPartyPaidAmount?: ?float,
     *   adjustmentsAmount?: ?float,
     *   netTransferAmount?: ?float,
     *   splitAmount?: ?float,
     *   eventsData?: ?array<TransferOutEventData>,
     *   messages?: ?array<TransferOutMessage>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->transferId = $values['transferId'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->batchCurrency = $values['batchCurrency'] ?? null;
        $this->batchRecords = $values['batchRecords'] ?? null;
        $this->transferIdentifier = $values['transferIdentifier'] ?? null;
        $this->batchId = $values['batchId'] ?? null;
        $this->batchNetAmount = $values['batchNetAmount'] ?? null;
        $this->batchStatus = $values['batchStatus'] ?? null;
        $this->paypointEntryName = $values['paypointEntryName'] ?? null;
        $this->paypointLegalName = $values['paypointLegalName'] ?? null;
        $this->paypointDbaName = $values['paypointDbaName'] ?? null;
        $this->paypointLogo = $values['paypointLogo'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->parentOrgLogo = $values['parentOrgLogo'] ?? null;
        $this->parentOrgEntryName = $values['parentOrgEntryName'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->bankAccount = $values['bankAccount'] ?? null;
        $this->transferDate = $values['transferDate'] ?? null;
        $this->processor = $values['processor'] ?? null;
        $this->transferStatus = $values['transferStatus'] ?? null;
        $this->grossAmount = $values['grossAmount'] ?? null;
        $this->chargeBackAmount = $values['chargeBackAmount'] ?? null;
        $this->returnedAmount = $values['returnedAmount'] ?? null;
        $this->holdAmount = $values['holdAmount'] ?? null;
        $this->releasedAmount = $values['releasedAmount'] ?? null;
        $this->billingFeesAmount = $values['billingFeesAmount'] ?? null;
        $this->thirdPartyPaidAmount = $values['thirdPartyPaidAmount'] ?? null;
        $this->adjustmentsAmount = $values['adjustmentsAmount'] ?? null;
        $this->netTransferAmount = $values['netTransferAmount'] ?? null;
        $this->splitAmount = $values['splitAmount'] ?? null;
        $this->eventsData = $values['eventsData'] ?? null;
        $this->messages = $values['messages'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
