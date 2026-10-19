<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

class BillResponseData extends JsonSerializableType
{
    /**
     * @var ?int $idBill
     */
    #[JsonProperty('IdBill')]
    public ?int $idBill;

    /**
     * @var ?string $billNumber Unique identifier for the bill.
     */
    #[JsonProperty('BillNumber')]
    public ?string $billNumber;

    /**
     * @var ?float $netAmount Net amount owed in bill.
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $discount Bill discount amount.
     */
    #[JsonProperty('Discount')]
    public ?float $discount;

    /**
     * @var ?float $totalAmount Total amount for the bill.
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $paidAmount The amount paid toward the bill so far.
     */
    #[JsonProperty('PaidAmount')]
    public ?float $paidAmount;

    /**
     * @var ?float $outstandingBalance The amount still owed on the bill, calculated as `NetAmount` minus `PaidAmount`.
     */
    #[JsonProperty('OutstandingBalance')]
    public ?float $outstandingBalance;

    /**
     * @var ?DateTime $billDate Date of bill, returned as a timestamp.
     */
    #[JsonProperty('BillDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $billDate;

    /**
     * @var ?DateTime $dueDate Due date of bill, returned as a timestamp.
     */
    #[JsonProperty('DueDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $dueDate;

    /**
     * @var ?string $comments Comments associated with the bill. For managed payables, the character limit is 200. For on demand payouts, the characters limit is 250.
     */
    #[JsonProperty('Comments')]
    public ?string $comments;

    /**
     * @var ?string $batchNumber The batch number that the bill belongs to.
     */
    #[JsonProperty('BatchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?array<BillItem> $billItems Array of `LineItems` contained in bill.
     */
    #[JsonProperty('BillItems'), ArrayType([BillItem::class])]
    public ?array $billItems;

    /**
     * @var ?int $mode Bill mode: value `0` for single/one-time bills, `1` for scheduled bills.
     */
    #[JsonProperty('Mode')]
    public ?int $mode;

    /**
     * @var ?string $paymentMethod Payment method used for the bill.
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?string $paymentId Payment ID associated with the bill.
     */
    #[JsonProperty('PaymentId')]
    public ?string $paymentId;

    /**
     * @var ?string $accountingField1
     */
    #[JsonProperty('AccountingField1')]
    public ?string $accountingField1;

    /**
     * @var ?string $accountingField2
     */
    #[JsonProperty('AccountingField2')]
    public ?string $accountingField2;

    /**
     * @var ?value-of<Terms> $terms
     */
    #[JsonProperty('Terms')]
    public ?string $terms;

    /**
     * @var ?string $source The source of the bill, such as "API" or "UI".
     */
    #[JsonProperty('Source')]
    public ?string $source;

    /**
     * @var ?array<string, string> $additionalData
     */
    #[JsonProperty('AdditionalData'), ArrayType(['string' => 'string'])]
    public ?array $additionalData;

    /**
     * @var ?VendorDataResponse $vendor
     */
    #[JsonProperty('Vendor')]
    public ?VendorDataResponse $vendor;

    /**
     * @var ?int $status
     */
    #[JsonProperty('Status')]
    public ?int $status;

    /**
     * @var ?DateTime $createdAt
     */
    #[JsonProperty('CreatedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?DateTime $endDate End date for scheduled bills. Applied only in `Mode` = 1.
     */
    #[JsonProperty('EndDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $endDate;

    /**
     * @var ?DateTime $lastUpdated
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?value-of<Frequency> $frequency Frequency for scheduled bills. Applied only in `Mode` = 1.
     */
    #[JsonProperty('Frequency')]
    public ?string $frequency;

    /**
     * @var ?TransactionOutQueryRecord $transaction MoneyOut transaction associated to the bill
     */
    #[JsonProperty('Transaction')]
    public ?TransactionOutQueryRecord $transaction;

    /**
     * All payout transactions that paid the bill, with one entry for each payout. When a bill is paid by several [partial payouts](/guides/pay-out-developer-bills-manage#partially-pay-a-bill), each one has an entry and `Transaction` holds the most recent. A bill paid by a single payout has one entry, and its `idOut` and `paymentId` match those on `Transaction`.
     *
     * Canceled payouts aren't included.
     *
     * The value is `null` when the bill has no payouts. When every payout on the bill has been canceled, the value is an empty array. If partial payments aren't enabled, a bill whose only payout was canceled returns `null` instead.
     *
     * Each entry has identifiers only. For a transaction's details, see [Get payout details](/developers/api-reference/moneyout/get-details-for-a-processed-payout-transaction).
     *
     * @var ?array<BillTransactionReference> $transactions
     */
    #[JsonProperty('transactions'), ArrayType([BillTransactionReference::class])]
    public ?array $transactions;

    /**
     * @var ?array<GeneralEvents> $billEvents
     */
    #[JsonProperty('billEvents'), ArrayType([GeneralEvents::class])]
    public ?array $billEvents;

    /**
     * @var ?array<BillQueryRecord2BillApprovalsItem> $billApprovals
     */
    #[JsonProperty('billApprovals'), ArrayType([BillQueryRecord2BillApprovalsItem::class])]
    public ?array $billApprovals;

    /**
     * @var ?string $paypointLegalname
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?int $parentOrgId
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $paypointEntryname
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paylinkId
     */
    #[JsonProperty('paylinkId')]
    public ?string $paylinkId;

    /**
     * @var ?DocumentsRef $documentsRef Object with the attached documents.
     */
    #[JsonProperty('DocumentsRef')]
    public ?DocumentsRef $documentsRef;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $lotNumber Lot number of the bill.
     */
    #[JsonProperty('LotNumber')]
    public ?string $lotNumber;

    /**
     * @var ?int $entityId
     */
    #[JsonProperty('EntityID')]
    public ?int $entityId;

    /**
     * @param array{
     *   idBill?: ?int,
     *   billNumber?: ?string,
     *   netAmount?: ?float,
     *   discount?: ?float,
     *   totalAmount?: ?float,
     *   paidAmount?: ?float,
     *   outstandingBalance?: ?float,
     *   billDate?: ?DateTime,
     *   dueDate?: ?DateTime,
     *   comments?: ?string,
     *   batchNumber?: ?string,
     *   billItems?: ?array<BillItem>,
     *   mode?: ?int,
     *   paymentMethod?: ?string,
     *   paymentId?: ?string,
     *   accountingField1?: ?string,
     *   accountingField2?: ?string,
     *   terms?: ?value-of<Terms>,
     *   source?: ?string,
     *   additionalData?: ?array<string, string>,
     *   vendor?: ?VendorDataResponse,
     *   status?: ?int,
     *   createdAt?: ?DateTime,
     *   endDate?: ?DateTime,
     *   lastUpdated?: ?DateTime,
     *   frequency?: ?value-of<Frequency>,
     *   transaction?: ?TransactionOutQueryRecord,
     *   transactions?: ?array<BillTransactionReference>,
     *   billEvents?: ?array<GeneralEvents>,
     *   billApprovals?: ?array<BillQueryRecord2BillApprovalsItem>,
     *   paypointLegalname?: ?string,
     *   paypointDbaname?: ?string,
     *   parentOrgId?: ?int,
     *   parentOrgName?: ?string,
     *   paypointEntryname?: ?string,
     *   paylinkId?: ?string,
     *   documentsRef?: ?DocumentsRef,
     *   externalPaypointId?: ?string,
     *   lotNumber?: ?string,
     *   entityId?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->idBill = $values['idBill'] ?? null;
        $this->billNumber = $values['billNumber'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->discount = $values['discount'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->paidAmount = $values['paidAmount'] ?? null;
        $this->outstandingBalance = $values['outstandingBalance'] ?? null;
        $this->billDate = $values['billDate'] ?? null;
        $this->dueDate = $values['dueDate'] ?? null;
        $this->comments = $values['comments'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->billItems = $values['billItems'] ?? null;
        $this->mode = $values['mode'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->paymentId = $values['paymentId'] ?? null;
        $this->accountingField1 = $values['accountingField1'] ?? null;
        $this->accountingField2 = $values['accountingField2'] ?? null;
        $this->terms = $values['terms'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
        $this->vendor = $values['vendor'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->endDate = $values['endDate'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->frequency = $values['frequency'] ?? null;
        $this->transaction = $values['transaction'] ?? null;
        $this->transactions = $values['transactions'] ?? null;
        $this->billEvents = $values['billEvents'] ?? null;
        $this->billApprovals = $values['billApprovals'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paylinkId = $values['paylinkId'] ?? null;
        $this->documentsRef = $values['documentsRef'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->lotNumber = $values['lotNumber'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
