<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class QueryPayoutTransactionSummary extends JsonSerializableType
{
    /**
     * @var ?int $totalPaid
     */
    #[JsonProperty('totalPaid')]
    public ?int $totalPaid;

    /**
     * @var ?float $totalPaidAmount
     */
    #[JsonProperty('totalPaidAmount')]
    public ?float $totalPaidAmount;

    /**
     * @var ?int $totalCanceled
     */
    #[JsonProperty('totalCanceled')]
    public ?int $totalCanceled;

    /**
     * @var ?float $totalCanceledAmount
     */
    #[JsonProperty('totalCanceledAmount')]
    public ?float $totalCanceledAmount;

    /**
     * @var ?int $totalCaptured
     */
    #[JsonProperty('totalCaptured')]
    public ?int $totalCaptured;

    /**
     * @var ?float $totalCapturedAmount
     */
    #[JsonProperty('totalCapturedAmount')]
    public ?float $totalCapturedAmount;

    /**
     * @var ?int $totalAuthorized
     */
    #[JsonProperty('totalAuthorized')]
    public ?int $totalAuthorized;

    /**
     * @var ?float $totalAuthorizedAmount
     */
    #[JsonProperty('totalAuthorizedAmount')]
    public ?float $totalAuthorizedAmount;

    /**
     * @var ?int $totalProcessing
     */
    #[JsonProperty('totalProcessing')]
    public ?int $totalProcessing;

    /**
     * @var ?float $totalProcessingAmount
     */
    #[JsonProperty('totalProcessingAmount')]
    public ?float $totalProcessingAmount;

    /**
     * @var ?int $totalOpen
     */
    #[JsonProperty('totalOpen')]
    public ?int $totalOpen;

    /**
     * @var ?float $totalOpenAmount
     */
    #[JsonProperty('totalOpenAmount')]
    public ?float $totalOpenAmount;

    /**
     * @var ?int $totalOnHold Total number of transactions that are currently on hold.
     */
    #[JsonProperty('totalOnHold')]
    public ?int $totalOnHold;

    /**
     * @var ?float $totalOnHoldAmount Total amount of transactions that are currently on hold.
     */
    #[JsonProperty('totalOnHoldAmount')]
    public ?float $totalOnHoldAmount;

    /**
     * @var ?int $totalRecords
     */
    #[JsonProperty('totalRecords')]
    public ?int $totalRecords;

    /**
     * @var ?float $totalAmount
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $totalNetAmount
     */
    #[JsonProperty('totalNetAmount')]
    public ?float $totalNetAmount;

    /**
     * @var ?int $totalPages
     */
    #[JsonProperty('totalPages')]
    public ?int $totalPages;

    /**
     * @var ?int $pageSize
     */
    #[JsonProperty('pageSize')]
    public ?int $pageSize;

    /**
     * @var ?string $pageidentifier
     */
    #[JsonProperty('pageidentifier')]
    public ?string $pageidentifier;

    /**
     * @param array{
     *   totalPaid?: ?int,
     *   totalPaidAmount?: ?float,
     *   totalCanceled?: ?int,
     *   totalCanceledAmount?: ?float,
     *   totalCaptured?: ?int,
     *   totalCapturedAmount?: ?float,
     *   totalAuthorized?: ?int,
     *   totalAuthorizedAmount?: ?float,
     *   totalProcessing?: ?int,
     *   totalProcessingAmount?: ?float,
     *   totalOpen?: ?int,
     *   totalOpenAmount?: ?float,
     *   totalOnHold?: ?int,
     *   totalOnHoldAmount?: ?float,
     *   totalRecords?: ?int,
     *   totalAmount?: ?float,
     *   totalNetAmount?: ?float,
     *   totalPages?: ?int,
     *   pageSize?: ?int,
     *   pageidentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->totalPaid = $values['totalPaid'] ?? null;
        $this->totalPaidAmount = $values['totalPaidAmount'] ?? null;
        $this->totalCanceled = $values['totalCanceled'] ?? null;
        $this->totalCanceledAmount = $values['totalCanceledAmount'] ?? null;
        $this->totalCaptured = $values['totalCaptured'] ?? null;
        $this->totalCapturedAmount = $values['totalCapturedAmount'] ?? null;
        $this->totalAuthorized = $values['totalAuthorized'] ?? null;
        $this->totalAuthorizedAmount = $values['totalAuthorizedAmount'] ?? null;
        $this->totalProcessing = $values['totalProcessing'] ?? null;
        $this->totalProcessingAmount = $values['totalProcessingAmount'] ?? null;
        $this->totalOpen = $values['totalOpen'] ?? null;
        $this->totalOpenAmount = $values['totalOpenAmount'] ?? null;
        $this->totalOnHold = $values['totalOnHold'] ?? null;
        $this->totalOnHoldAmount = $values['totalOnHoldAmount'] ?? null;
        $this->totalRecords = $values['totalRecords'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->totalNetAmount = $values['totalNetAmount'] ?? null;
        $this->totalPages = $values['totalPages'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
        $this->pageidentifier = $values['pageidentifier'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
