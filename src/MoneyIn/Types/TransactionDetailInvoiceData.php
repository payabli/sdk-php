<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Types\Frequency;
use Payabli\Types\BillItem;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\FileContent;

/**
 * Invoice information if transaction is associated with an invoice
 */
class TransactionDetailInvoiceData extends JsonSerializableType
{
    /**
     * @var ?string $invoiceNumber
     */
    #[JsonProperty('invoiceNumber')]
    public ?string $invoiceNumber;

    /**
     * @var ?DateTime $invoiceDate
     */
    #[JsonProperty('invoiceDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $invoiceDate;

    /**
     * @var ?DateTime $invoiceDueDate
     */
    #[JsonProperty('invoiceDueDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $invoiceDueDate;

    /**
     * @var ?DateTime $invoiceEndDate
     */
    #[JsonProperty('invoiceEndDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $invoiceEndDate;

    /**
     * @var ?int $invoiceStatus
     */
    #[JsonProperty('invoiceStatus')]
    public ?int $invoiceStatus;

    /**
     * @var ?int $invoiceType
     */
    #[JsonProperty('invoiceType')]
    public ?int $invoiceType;

    /**
     * @var ?value-of<Frequency> $frequency
     */
    #[JsonProperty('frequency')]
    public ?string $frequency;

    /**
     * @var ?string $paymentTerms
     */
    #[JsonProperty('paymentTerms')]
    public ?string $paymentTerms;

    /**
     * @var ?string $termsConditions
     */
    #[JsonProperty('termsConditions')]
    public ?string $termsConditions;

    /**
     * @var ?string $notes
     */
    #[JsonProperty('notes')]
    public ?string $notes;

    /**
     * @var ?float $tax
     */
    #[JsonProperty('tax')]
    public ?float $tax;

    /**
     * @var ?float $discount
     */
    #[JsonProperty('discount')]
    public ?float $discount;

    /**
     * @var ?float $invoiceAmount
     */
    #[JsonProperty('invoiceAmount')]
    public ?float $invoiceAmount;

    /**
     * @var ?float $freightAmount
     */
    #[JsonProperty('freightAmount')]
    public ?float $freightAmount;

    /**
     * @var ?float $dutyAmount
     */
    #[JsonProperty('dutyAmount')]
    public ?float $dutyAmount;

    /**
     * @var ?string $purchaseOrder
     */
    #[JsonProperty('purchaseOrder')]
    public ?string $purchaseOrder;

    /**
     * @var ?string $firstName
     */
    #[JsonProperty('firstName')]
    public ?string $firstName;

    /**
     * @var ?string $lastName
     */
    #[JsonProperty('lastName')]
    public ?string $lastName;

    /**
     * @var ?string $company
     */
    #[JsonProperty('company')]
    public ?string $company;

    /**
     * @var ?string $shippingAddress1
     */
    #[JsonProperty('shippingAddress1')]
    public ?string $shippingAddress1;

    /**
     * @var ?string $shippingAddress2
     */
    #[JsonProperty('shippingAddress2')]
    public ?string $shippingAddress2;

    /**
     * @var ?string $shippingCity
     */
    #[JsonProperty('shippingCity')]
    public ?string $shippingCity;

    /**
     * @var ?string $shippingState
     */
    #[JsonProperty('shippingState')]
    public ?string $shippingState;

    /**
     * @var ?string $shippingZip
     */
    #[JsonProperty('shippingZip')]
    public ?string $shippingZip;

    /**
     * @var ?string $shippingCountry
     */
    #[JsonProperty('shippingCountry')]
    public ?string $shippingCountry;

    /**
     * @var ?string $shippingEmail
     */
    #[JsonProperty('shippingEmail')]
    public ?string $shippingEmail;

    /**
     * @var ?string $shippingPhone
     */
    #[JsonProperty('shippingPhone')]
    public ?string $shippingPhone;

    /**
     * @var ?string $shippingFromZip
     */
    #[JsonProperty('shippingFromZip')]
    public ?string $shippingFromZip;

    /**
     * @var ?string $summaryCommodityCode
     */
    #[JsonProperty('summaryCommodityCode')]
    public ?string $summaryCommodityCode;

    /**
     * @var ?array<BillItem> $items
     */
    #[JsonProperty('items'), ArrayType([BillItem::class])]
    public ?array $items;

    /**
     * @var ?array<FileContent> $attachments
     */
    #[JsonProperty('attachments'), ArrayType([FileContent::class])]
    public ?array $attachments;

    /**
     * @var ?string $additionalData
     */
    #[JsonProperty('additionalData')]
    public ?string $additionalData;

    /**
     * @param array{
     *   invoiceNumber?: ?string,
     *   invoiceDate?: ?DateTime,
     *   invoiceDueDate?: ?DateTime,
     *   invoiceEndDate?: ?DateTime,
     *   invoiceStatus?: ?int,
     *   invoiceType?: ?int,
     *   frequency?: ?value-of<Frequency>,
     *   paymentTerms?: ?string,
     *   termsConditions?: ?string,
     *   notes?: ?string,
     *   tax?: ?float,
     *   discount?: ?float,
     *   invoiceAmount?: ?float,
     *   freightAmount?: ?float,
     *   dutyAmount?: ?float,
     *   purchaseOrder?: ?string,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   company?: ?string,
     *   shippingAddress1?: ?string,
     *   shippingAddress2?: ?string,
     *   shippingCity?: ?string,
     *   shippingState?: ?string,
     *   shippingZip?: ?string,
     *   shippingCountry?: ?string,
     *   shippingEmail?: ?string,
     *   shippingPhone?: ?string,
     *   shippingFromZip?: ?string,
     *   summaryCommodityCode?: ?string,
     *   items?: ?array<BillItem>,
     *   attachments?: ?array<FileContent>,
     *   additionalData?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->invoiceNumber = $values['invoiceNumber'] ?? null;
        $this->invoiceDate = $values['invoiceDate'] ?? null;
        $this->invoiceDueDate = $values['invoiceDueDate'] ?? null;
        $this->invoiceEndDate = $values['invoiceEndDate'] ?? null;
        $this->invoiceStatus = $values['invoiceStatus'] ?? null;
        $this->invoiceType = $values['invoiceType'] ?? null;
        $this->frequency = $values['frequency'] ?? null;
        $this->paymentTerms = $values['paymentTerms'] ?? null;
        $this->termsConditions = $values['termsConditions'] ?? null;
        $this->notes = $values['notes'] ?? null;
        $this->tax = $values['tax'] ?? null;
        $this->discount = $values['discount'] ?? null;
        $this->invoiceAmount = $values['invoiceAmount'] ?? null;
        $this->freightAmount = $values['freightAmount'] ?? null;
        $this->dutyAmount = $values['dutyAmount'] ?? null;
        $this->purchaseOrder = $values['purchaseOrder'] ?? null;
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->company = $values['company'] ?? null;
        $this->shippingAddress1 = $values['shippingAddress1'] ?? null;
        $this->shippingAddress2 = $values['shippingAddress2'] ?? null;
        $this->shippingCity = $values['shippingCity'] ?? null;
        $this->shippingState = $values['shippingState'] ?? null;
        $this->shippingZip = $values['shippingZip'] ?? null;
        $this->shippingCountry = $values['shippingCountry'] ?? null;
        $this->shippingEmail = $values['shippingEmail'] ?? null;
        $this->shippingPhone = $values['shippingPhone'] ?? null;
        $this->shippingFromZip = $values['shippingFromZip'] ?? null;
        $this->summaryCommodityCode = $values['summaryCommodityCode'] ?? null;
        $this->items = $values['items'] ?? null;
        $this->attachments = $values['attachments'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
