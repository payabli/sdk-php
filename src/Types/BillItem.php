<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class BillItem extends JsonSerializableType
{
    /**
     * @var ?array<string> $itemCategories Array of tags classifying item or product.
     */
    #[JsonProperty('itemCategories'), ArrayType(['string'])]
    public ?array $itemCategories;

    /**
     * @var ?string $itemCommodityCode
     */
    #[JsonProperty('itemCommodityCode')]
    public ?string $itemCommodityCode;

    /**
     * @var ?float $itemCost Item or product price per unit.
     */
    #[JsonProperty('itemCost')]
    public ?float $itemCost;

    /**
     * @var ?string $itemDescription
     */
    #[JsonProperty('itemDescription')]
    public ?string $itemDescription;

    /**
     * Internal class of item or product: value `0` is only for invoices,
     * `1` for bills, and `2` is common for both. Required on invoice line
     * items — invoice creation fails with `Invalid item data` if it's omitted.
     *
     * @var ?int $itemMode
     */
    #[JsonProperty('itemMode')]
    public ?int $itemMode;

    /**
     * @var ?string $itemProductCode
     */
    #[JsonProperty('itemProductCode')]
    public ?string $itemProductCode;

    /**
     * @var ?string $itemProductName
     */
    #[JsonProperty('itemProductName')]
    public ?string $itemProductName;

    /**
     * @var ?int $itemQty Quantity of item or product.
     */
    #[JsonProperty('itemQty')]
    public ?int $itemQty;

    /**
     * @var ?float $itemTaxAmount Tax amount applied to item or product.
     */
    #[JsonProperty('itemTaxAmount')]
    public ?float $itemTaxAmount;

    /**
     * @var ?float $itemTaxRate Tax rate applied to item or product.
     */
    #[JsonProperty('itemTaxRate')]
    public ?float $itemTaxRate;

    /**
     * Per-line total for this item (unit cost times quantity). Distinct from
     * the invoice's overall total, `invoiceAmount`. Required on invoice line items.
     *
     * @var ?float $itemTotalAmount
     */
    #[JsonProperty('itemTotalAmount')]
    public ?float $itemTotalAmount;

    /**
     * @var ?string $itemUnitOfMeasure
     */
    #[JsonProperty('itemUnitOfMeasure')]
    public ?string $itemUnitOfMeasure;

    /**
     * @param array{
     *   itemCategories?: ?array<string>,
     *   itemCommodityCode?: ?string,
     *   itemCost?: ?float,
     *   itemDescription?: ?string,
     *   itemMode?: ?int,
     *   itemProductCode?: ?string,
     *   itemProductName?: ?string,
     *   itemQty?: ?int,
     *   itemTaxAmount?: ?float,
     *   itemTaxRate?: ?float,
     *   itemTotalAmount?: ?float,
     *   itemUnitOfMeasure?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->itemCategories = $values['itemCategories'] ?? null;
        $this->itemCommodityCode = $values['itemCommodityCode'] ?? null;
        $this->itemCost = $values['itemCost'] ?? null;
        $this->itemDescription = $values['itemDescription'] ?? null;
        $this->itemMode = $values['itemMode'] ?? null;
        $this->itemProductCode = $values['itemProductCode'] ?? null;
        $this->itemProductName = $values['itemProductName'] ?? null;
        $this->itemQty = $values['itemQty'] ?? null;
        $this->itemTaxAmount = $values['itemTaxAmount'] ?? null;
        $this->itemTaxRate = $values['itemTaxRate'] ?? null;
        $this->itemTotalAmount = $values['itemTotalAmount'] ?? null;
        $this->itemUnitOfMeasure = $values['itemUnitOfMeasure'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
