<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A virtual card transaction record returned by the query.
 */
class VCardTransactionRecord extends JsonSerializableType
{
    /**
     * @var ?string $identifier Unique identifier for the transaction.
     */
    #[JsonProperty('Identifier')]
    public ?string $identifier;

    /**
     * @var ?string $cardToken Token of the virtual card associated with the transaction.
     */
    #[JsonProperty('CardToken')]
    public ?string $cardToken;

    /**
     * @var ?string $lastFour Last four digits of the masked virtual card number.
     */
    #[JsonProperty('LastFour')]
    public ?string $lastFour;

    /**
     * @var ?string $expirationDate Expiration date of the virtual card used for the transaction.
     */
    #[JsonProperty('ExpirationDate')]
    public ?string $expirationDate;

    /**
     * @var ?string $mcc
     */
    #[JsonProperty('Mcc')]
    public ?string $mcc;

    /**
     * @var ?int $payoutId Identifier of the payout linked to this transaction.
     */
    #[JsonProperty('PayoutId')]
    public ?int $payoutId;

    /**
     * @var ?int $customerId Identifier of the customer linked to this transaction.
     */
    #[JsonProperty('CustomerId')]
    public ?int $customerId;

    /**
     * @var ?int $vendorId Identifier of the vendor linked to this transaction.
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $miscData1 Custom field 1 from the virtual card.
     */
    #[JsonProperty('MiscData1')]
    public ?string $miscData1;

    /**
     * @var ?string $miscData2 Custom field 2 from the virtual card.
     */
    #[JsonProperty('MiscData2')]
    public ?string $miscData2;

    /**
     * @var ?int $currentUses Number of times the virtual card has been used.
     */
    #[JsonProperty('CurrentUses')]
    public ?int $currentUses;

    /**
     * @var ?float $amount Authorized amount on the virtual card.
     */
    #[JsonProperty('Amount')]
    public ?float $amount;

    /**
     * @var ?float $balance Current balance remaining on the virtual card.
     */
    #[JsonProperty('Balance')]
    public ?float $balance;

    /**
     * @var ?int $paypointId Numeric identifier of the paypoint that issued the virtual card.
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $paypointLegal
     */
    #[JsonProperty('PaypointLegal')]
    public ?string $paypointLegal;

    /**
     * @var ?string $paypointDba
     */
    #[JsonProperty('PaypointDba')]
    public ?string $paypointDba;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('ExternalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $orgName
     */
    #[JsonProperty('OrgName')]
    public ?string $orgName;

    /**
     * @var ?string $type Transaction type, such as `AUTHORIZATION`.
     */
    #[JsonProperty('Type')]
    public ?string $type;

    /**
     * @var ?string $status Transaction status, such as `AUTHORIZATION`.
     */
    #[JsonProperty('Status')]
    public ?string $status;

    /**
     * @var ?string $createdOn Date and time the transaction was created. Format: `YYYY-MM-DD HH:MM:SS.ffffff`.
     */
    #[JsonProperty('CreatedOn')]
    public ?string $createdOn;

    /**
     * @var ?string $transactionAmount Amount of the transaction, as a string value.
     */
    #[JsonProperty('TransactionAmount')]
    public ?string $transactionAmount;

    /**
     * @var ?string $postedAmount Posted amount of the transaction, as a string value.
     */
    #[JsonProperty('PostedAmount')]
    public ?string $postedAmount;

    /**
     * @var ?string $postedOn Date and time the transaction was posted, in format `YYYY-MM-DD HH:MM:SS.ffffff`. Null when the transaction hasn't posted yet.
     */
    #[JsonProperty('PostedOn')]
    public ?string $postedOn;

    /**
     * @var ?string $merchantName Name of the merchant where the virtual card was used.
     */
    #[JsonProperty('MerchantName')]
    public ?string $merchantName;

    /**
     * @var ?string $authorizationStatus Authorization status of the transaction.
     */
    #[JsonProperty('AuthorizationStatus')]
    public ?string $authorizationStatus;

    /**
     * @var ?string $reasonToDecline Reason the transaction was declined, when applicable.
     */
    #[JsonProperty('ReasonToDecline')]
    public ?string $reasonToDecline;

    /**
     * @param array{
     *   identifier?: ?string,
     *   cardToken?: ?string,
     *   lastFour?: ?string,
     *   expirationDate?: ?string,
     *   mcc?: ?string,
     *   payoutId?: ?int,
     *   customerId?: ?int,
     *   vendorId?: ?int,
     *   miscData1?: ?string,
     *   miscData2?: ?string,
     *   currentUses?: ?int,
     *   amount?: ?float,
     *   balance?: ?float,
     *   paypointId?: ?int,
     *   paypointLegal?: ?string,
     *   paypointDba?: ?string,
     *   externalPaypointId?: ?string,
     *   orgName?: ?string,
     *   type?: ?string,
     *   status?: ?string,
     *   createdOn?: ?string,
     *   transactionAmount?: ?string,
     *   postedAmount?: ?string,
     *   postedOn?: ?string,
     *   merchantName?: ?string,
     *   authorizationStatus?: ?string,
     *   reasonToDecline?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifier = $values['identifier'] ?? null;
        $this->cardToken = $values['cardToken'] ?? null;
        $this->lastFour = $values['lastFour'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->mcc = $values['mcc'] ?? null;
        $this->payoutId = $values['payoutId'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
        $this->miscData1 = $values['miscData1'] ?? null;
        $this->miscData2 = $values['miscData2'] ?? null;
        $this->currentUses = $values['currentUses'] ?? null;
        $this->amount = $values['amount'] ?? null;
        $this->balance = $values['balance'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointLegal = $values['paypointLegal'] ?? null;
        $this->paypointDba = $values['paypointDba'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->orgName = $values['orgName'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->createdOn = $values['createdOn'] ?? null;
        $this->transactionAmount = $values['transactionAmount'] ?? null;
        $this->postedAmount = $values['postedAmount'] ?? null;
        $this->postedOn = $values['postedOn'] ?? null;
        $this->merchantName = $values['merchantName'] ?? null;
        $this->authorizationStatus = $values['authorizationStatus'] ?? null;
        $this->reasonToDecline = $values['reasonToDecline'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
