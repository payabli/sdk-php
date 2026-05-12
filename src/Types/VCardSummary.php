<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class VCardSummary extends JsonSerializableType
{
    /**
     * @var int $totalPages
     */
    #[JsonProperty('totalPages')]
    public int $totalPages;

    /**
     * @var int $totalRecords
     */
    #[JsonProperty('totalRecords')]
    public int $totalRecords;

    /**
     * @var float $totalAmount Total amount for the records.
     */
    #[JsonProperty('totalAmount')]
    public float $totalAmount;

    /**
     * @var ?float $totalNetAmount Total net amount for the records.
     */
    #[JsonProperty('totalNetAmount')]
    public ?float $totalNetAmount;

    /**
     * @var int $totalactive Total number of active vCards.
     */
    #[JsonProperty('totalactive')]
    public int $totalactive;

    /**
     * @var float $totalamountactive Total amount of active vCards.
     */
    #[JsonProperty('totalamountactive')]
    public float $totalamountactive;

    /**
     * @var float $totalbalanceactive Total balance of active vCards.
     */
    #[JsonProperty('totalbalanceactive')]
    public float $totalbalanceactive;

    /**
     * @var ?string $pageidentifier
     */
    #[JsonProperty('pageidentifier')]
    public ?string $pageidentifier;

    /**
     * @var ?int $pageSize
     */
    #[JsonProperty('pageSize')]
    public ?int $pageSize;

    /**
     * @param array{
     *   totalPages: int,
     *   totalRecords: int,
     *   totalAmount: float,
     *   totalactive: int,
     *   totalamountactive: float,
     *   totalbalanceactive: float,
     *   totalNetAmount?: ?float,
     *   pageidentifier?: ?string,
     *   pageSize?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalPages = $values['totalPages'];
        $this->totalRecords = $values['totalRecords'];
        $this->totalAmount = $values['totalAmount'];
        $this->totalNetAmount = $values['totalNetAmount'] ?? null;
        $this->totalactive = $values['totalactive'];
        $this->totalamountactive = $values['totalamountactive'];
        $this->totalbalanceactive = $values['totalbalanceactive'];
        $this->pageidentifier = $values['pageidentifier'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
