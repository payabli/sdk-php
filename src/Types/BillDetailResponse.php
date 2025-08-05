<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class BillDetailResponse extends JsonSerializableType
{
    /**
     * @var ?array<BillDetailsResponse> $bills Events associated to this transaction.
     */
    #[JsonProperty('Bills'), ArrayType([BillDetailsResponse::class])]
    public ?array $bills;

    /**
     * @var ?FileContent $checkData Object referencing to paper check image.
     */
    #[JsonProperty('CheckData')]
    public ?FileContent $checkData;

    /**
     * @var ?string $checkNumber Paper check number related to payout transaction.
     */
    #[JsonProperty('CheckNumber')]
    public ?string $checkNumber;

    /**
     * @var ?string $comments Any comment or description for payout transaction.
     */
    #[JsonProperty('Comments')]
    public ?string $comments;

    /**
     * @var ?DateTime $createdDate Timestamp when the payment was created, in UTC.
     */
    #[JsonProperty('CreatedDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdDate;

    /**
     * @var ?array<QueryTransactionEvents> $events Events associated to this transaction.
     */
    #[JsonProperty('Events'), ArrayType([QueryTransactionEvents::class])]
    public ?array $events;

    /**
     * @var ?float $feeAmount Service fee or sub-charge applied.
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?string $gateway
     */
    #[JsonProperty('Gateway')]
    public ?string $gateway;

    /**
     * @var ?int $idOut Identifier of payout transaction.
     */
    #[JsonProperty('IdOut')]
    public ?int $idOut;

    /**
     * @var ?DateTime $lastUpdated Timestamp when payment record was updated, in UTC.
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?float $netAmount
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?QueryPaymentData $paymentData
     */
    #[JsonProperty('PaymentData')]
    public ?QueryPaymentData $paymentData;

    /**
     * @var ?string $paymentGroup Unique identifier for group or batch containing the transaction.
     */
    #[JsonProperty('PaymentGroup')]
    public ?string $paymentGroup;

    /**
     * @var ?string $paymentId
     */
    #[JsonProperty('PaymentId')]
    public ?string $paymentId;

    /**
     * @var ?string $paymentMethod Method of payment applied to the transaction.
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?string $paymentStatus Status of payout transaction.
     */
    #[JsonProperty('PaymentStatus')]
    public ?string $paymentStatus;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointLegalname Paypoint legal name.
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $source
     */
    #[JsonProperty('Source')]
    public ?string $source;

    /**
     * @var ?int $status Internal status of transaction.
     */
    #[JsonProperty('Status')]
    public ?int $status;

    /**
     * @var ?string $statusText Status of payout transaction.
     */
    #[JsonProperty('StatusText')]
    public ?string $statusText;

    /**
     * @var ?float $totalAmount Transaction total amount (including service fee or sub-charge).
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?VendorQueryRecord $vendor Vendor related to the payout transaction.
     */
    #[JsonProperty('Vendor')]
    public ?VendorQueryRecord $vendor;

    /**
     * @param array{
     *   bills?: ?array<BillDetailsResponse>,
     *   checkData?: ?FileContent,
     *   checkNumber?: ?string,
     *   comments?: ?string,
     *   createdDate?: ?DateTime,
     *   events?: ?array<QueryTransactionEvents>,
     *   feeAmount?: ?float,
     *   gateway?: ?string,
     *   idOut?: ?int,
     *   lastUpdated?: ?DateTime,
     *   netAmount?: ?float,
     *   parentOrgName?: ?string,
     *   paymentData?: ?QueryPaymentData,
     *   paymentGroup?: ?string,
     *   paymentId?: ?string,
     *   paymentMethod?: ?string,
     *   paymentStatus?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointLegalname?: ?string,
     *   source?: ?string,
     *   status?: ?int,
     *   statusText?: ?string,
     *   totalAmount?: ?float,
     *   vendor?: ?VendorQueryRecord,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bills = $values['bills'] ?? null;
        $this->checkData = $values['checkData'] ?? null;
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->comments = $values['comments'] ?? null;
        $this->createdDate = $values['createdDate'] ?? null;
        $this->events = $values['events'] ?? null;
        $this->feeAmount = $values['feeAmount'] ?? null;
        $this->gateway = $values['gateway'] ?? null;
        $this->idOut = $values['idOut'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paymentData = $values['paymentData'] ?? null;
        $this->paymentGroup = $values['paymentGroup'] ?? null;
        $this->paymentId = $values['paymentId'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->paymentStatus = $values['paymentStatus'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->statusText = $values['statusText'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->vendor = $values['vendor'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
