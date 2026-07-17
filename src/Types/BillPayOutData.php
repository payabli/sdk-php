<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class BillPayOutData extends JsonSerializableType
{
    /**
     * @var ?int $billId Bill ID in Payabli.
     */
    #[JsonProperty('billId')]
    public ?int $billId;

    /**
     * @var ?string $lotNumber Lot number associated with the bill.
     */
    #[JsonProperty('LotNumber')]
    public ?string $lotNumber;

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
     * @var ?value-of<Terms> $terms Description of payment terms.
     */
    #[JsonProperty('Terms')]
    public ?string $terms;

    /**
     * @var ?string $additionalData
     */
    #[JsonProperty('AdditionalData')]
    public ?string $additionalData;

    /**
     * @var ?array<FileContent> $attachments Bill image attachment. Send the bill image as Base64-encoded string, or as a publicly accessible link. For full details on using this field with a payout authorization, see [the documentation](/developers/developer-guides/pay-out-manage-payouts).
     */
    #[JsonProperty('attachments'), ArrayType([FileContent::class])]
    public ?array $attachments;

    /**
     * @var ?string $invoiceNumber Custom number identifying the bill. Must be unique in paypoint. **Required** for new bill and when `billId` isn't provided.
     */
    #[JsonProperty('invoiceNumber')]
    public ?string $invoiceNumber;

    /**
     * @var ?string $netAmount Net Amount owed in bill. Required when adding a bill.
     */
    #[JsonProperty('netAmount')]
    public ?string $netAmount;

    /**
     * @var ?DateTime $invoiceDate Bill date in format YYYY-MM-DD or MM/DD/YYYY.
     */
    #[JsonProperty('invoiceDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $invoiceDate;

    /**
     * @var ?DateTime $dueDate Bill due date in format YYYY-MM-DD or MM/DD/YYYY.
     */
    #[JsonProperty('dueDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $dueDate;

    /**
     * @var ?string $comments Any comments about bill. **For managed payouts, this field has a limit of 100 characters**.
     */
    #[JsonProperty('comments')]
    public ?string $comments;

    /**
     * @var ?string $identifier Custom identifier for the bill.
     */
    #[JsonProperty('identifier')]
    public ?string $identifier;

    /**
     * @var ?string $discount Bill discount amount.
     */
    #[JsonProperty('discount')]
    public ?string $discount;

    /**
     * @var ?string $totalAmount Total amount of the bill.
     */
    #[JsonProperty('totalAmount')]
    public ?string $totalAmount;

    /**
     * @param array{
     *   billId?: ?int,
     *   lotNumber?: ?string,
     *   accountingField1?: ?string,
     *   accountingField2?: ?string,
     *   terms?: ?value-of<Terms>,
     *   additionalData?: ?string,
     *   attachments?: ?array<FileContent>,
     *   invoiceNumber?: ?string,
     *   netAmount?: ?string,
     *   invoiceDate?: ?DateTime,
     *   dueDate?: ?DateTime,
     *   comments?: ?string,
     *   identifier?: ?string,
     *   discount?: ?string,
     *   totalAmount?: ?string,
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
