<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Bill information for an outbound transfer detail.
 */
class TransferOutDetailBill extends JsonSerializableType
{
    /**
     * @var ?int $billId Unique identifier for the bill.
     */
    #[JsonProperty('billId')]
    public ?int $billId;

    /**
     * @var ?string $lotNumber Lot number.
     */
    #[JsonProperty('LotNumber')]
    public ?string $lotNumber;

    /**
     * @var ?string $accountingField1 Accounting field 1.
     */
    #[JsonProperty('AccountingField1')]
    public ?string $accountingField1;

    /**
     * @var ?string $accountingField2 Accounting field 2.
     */
    #[JsonProperty('AccountingField2')]
    public ?string $accountingField2;

    /**
     * @var ?string $terms Payment terms.
     */
    #[JsonProperty('Terms')]
    public ?string $terms;

    /**
     * @var ?array<string, mixed> $additionalData Additional data for the bill.
     */
    #[JsonProperty('AdditionalData'), ArrayType(['string' => 'mixed'])]
    public ?array $additionalData;

    /**
     * @var ?array<TransferOutDetailBillAttachment> $attachments Attachments for the bill.
     */
    #[JsonProperty('attachments'), ArrayType([TransferOutDetailBillAttachment::class])]
    public ?array $attachments;

    /**
     * @var ?string $invoiceNumber Invoice number.
     */
    #[JsonProperty('invoiceNumber')]
    public ?string $invoiceNumber;

    /**
     * @var ?string $netAmount Net amount of the bill.
     */
    #[JsonProperty('netAmount')]
    public ?string $netAmount;

    /**
     * @var ?string $invoiceDate Date of the invoice.
     */
    #[JsonProperty('invoiceDate')]
    public ?string $invoiceDate;

    /**
     * @var ?string $dueDate Due date for the bill.
     */
    #[JsonProperty('dueDate')]
    public ?string $dueDate;

    /**
     * @var ?string $comments Comments on the bill.
     */
    #[JsonProperty('comments')]
    public ?string $comments;

    /**
     * @var ?string $identifier Identifier for the bill.
     */
    #[JsonProperty('identifier')]
    public ?string $identifier;

    /**
     * @var ?float $discount Discount applied.
     */
    #[JsonProperty('discount')]
    public ?float $discount;

    /**
     * @var ?float $totalAmount Total amount of the bill.
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @param array{
     *   billId?: ?int,
     *   lotNumber?: ?string,
     *   accountingField1?: ?string,
     *   accountingField2?: ?string,
     *   terms?: ?string,
     *   additionalData?: ?array<string, mixed>,
     *   attachments?: ?array<TransferOutDetailBillAttachment>,
     *   invoiceNumber?: ?string,
     *   netAmount?: ?string,
     *   invoiceDate?: ?string,
     *   dueDate?: ?string,
     *   comments?: ?string,
     *   identifier?: ?string,
     *   discount?: ?float,
     *   totalAmount?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->billId = $values['billId'] ?? null;
        $this->lotNumber = $values['lotNumber'] ?? null;
        $this->accountingField1 = $values['accountingField1'] ?? null;
        $this->accountingField2 = $values['accountingField2'] ?? null;
        $this->terms = $values['terms'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
        $this->attachments = $values['attachments'] ?? null;
        $this->invoiceNumber = $values['invoiceNumber'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->invoiceDate = $values['invoiceDate'] ?? null;
        $this->dueDate = $values['dueDate'] ?? null;
        $this->comments = $values['comments'] ?? null;
        $this->identifier = $values['identifier'] ?? null;
        $this->discount = $values['discount'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
