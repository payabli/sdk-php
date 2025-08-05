<?php

namespace Payabli\MoneyOut\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class VCardGetResponse extends JsonSerializableType
{
    /**
     * @var ?float $amount The initial amount loaded on the card.
     */
    #[JsonProperty('amount')]
    public ?float $amount;

    /**
     * @var ?string $associatedCustomer Information about the associated customer, if applicable.
     */
    #[JsonProperty('associatedCustomer')]
    public ?string $associatedCustomer;

    /**
     * @var ?VCardGetResponseAssociatedVendor $associatedVendor Information about the associated vendor.
     */
    #[JsonProperty('associatedVendor')]
    public ?VCardGetResponseAssociatedVendor $associatedVendor;

    /**
     * @var ?string $cardNumber The masked number of the card.
     */
    #[JsonProperty('cardNumber')]
    public ?string $cardNumber;

    /**
     * @var ?string $cardToken A unique token identifier for the card.
     */
    #[JsonProperty('cardToken')]
    public ?string $cardToken;

    /**
     * @var ?float $currentBalance The current balance available on the card.
     */
    #[JsonProperty('currentBalance')]
    public ?float $currentBalance;

    /**
     * @var ?int $currentNumberOfUses The current number of times the card has been used.
     */
    #[JsonProperty('currentNumberOfUses')]
    public ?int $currentNumberOfUses;

    /**
     * @var ?string $cvc Masked Card Verification Code.
     */
    #[JsonProperty('cvc')]
    public ?string $cvc;

    /**
     * @var ?string $dateCreated The creation date of the record.
     */
    #[JsonProperty('dateCreated')]
    public ?string $dateCreated;

    /**
     * @var ?string $dateModified The last modified date of the record.
     */
    #[JsonProperty('dateModified')]
    public ?string $dateModified;

    /**
     * @var ?bool $exactAmount Indicates if only the exact amount is allowed for transactions.
     */
    #[JsonProperty('exactAmount')]
    public ?bool $exactAmount;

    /**
     * @var ?float $expenseLimit The set limit for expenses.
     */
    #[JsonProperty('expenseLimit')]
    public ?float $expenseLimit;

    /**
     * @var ?string $expenseLimitPeriod The period for the expense limit.
     */
    #[JsonProperty('expenseLimitPeriod')]
    public ?string $expenseLimitPeriod;

    /**
     * @var ?string $expirationDate The expiration date of the card.
     */
    #[JsonProperty('expirationDate')]
    public ?string $expirationDate;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $maxNumberOfUses Maximum number of uses allowed for the card.
     */
    #[JsonProperty('maxNumberOfUses')]
    public ?int $maxNumberOfUses;

    /**
     * @var ?string $mcc Merchant Category Code, if applicable.
     */
    #[JsonProperty('mcc')]
    public ?string $mcc;

    /**
     * @var ?string $misc1 A miscellaneous field for additional information.
     */
    #[JsonProperty('misc1')]
    public ?string $misc1;

    /**
     * @var ?string $misc2 Another miscellaneous field for extra information.
     */
    #[JsonProperty('misc2')]
    public ?string $misc2;

    /**
     * @var ?string $parentOrgName Name of the parent organization.
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $paypointDbaname The 'Doing Business As' name of the Paypoint.
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname Entry name for the Paypoint, if applicable.
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointLegalname The legal name of the Paypoint.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $status The current status of the card.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?string $tcc Transaction Category Code, if applicable.
     */
    #[JsonProperty('tcc')]
    public ?string $tcc;

    /**
     * @var ?bool $vcardSent Indicates if the virtual card was sent.
     */
    #[JsonProperty('vcardSent')]
    public ?bool $vcardSent;

    /**
     * @param array{
     *   amount?: ?float,
     *   associatedCustomer?: ?string,
     *   associatedVendor?: ?VCardGetResponseAssociatedVendor,
     *   cardNumber?: ?string,
     *   cardToken?: ?string,
     *   currentBalance?: ?float,
     *   currentNumberOfUses?: ?int,
     *   cvc?: ?string,
     *   dateCreated?: ?string,
     *   dateModified?: ?string,
     *   exactAmount?: ?bool,
     *   expenseLimit?: ?float,
     *   expenseLimitPeriod?: ?string,
     *   expirationDate?: ?string,
     *   externalPaypointId?: ?string,
     *   maxNumberOfUses?: ?int,
     *   mcc?: ?string,
     *   misc1?: ?string,
     *   misc2?: ?string,
     *   parentOrgName?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   paypointLegalname?: ?string,
     *   status?: ?string,
     *   tcc?: ?string,
     *   vcardSent?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->amount = $values['amount'] ?? null;
        $this->associatedCustomer = $values['associatedCustomer'] ?? null;
        $this->associatedVendor = $values['associatedVendor'] ?? null;
        $this->cardNumber = $values['cardNumber'] ?? null;
        $this->cardToken = $values['cardToken'] ?? null;
        $this->currentBalance = $values['currentBalance'] ?? null;
        $this->currentNumberOfUses = $values['currentNumberOfUses'] ?? null;
        $this->cvc = $values['cvc'] ?? null;
        $this->dateCreated = $values['dateCreated'] ?? null;
        $this->dateModified = $values['dateModified'] ?? null;
        $this->exactAmount = $values['exactAmount'] ?? null;
        $this->expenseLimit = $values['expenseLimit'] ?? null;
        $this->expenseLimitPeriod = $values['expenseLimitPeriod'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->maxNumberOfUses = $values['maxNumberOfUses'] ?? null;
        $this->mcc = $values['mcc'] ?? null;
        $this->misc1 = $values['misc1'] ?? null;
        $this->misc2 = $values['misc2'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->tcc = $values['tcc'] ?? null;
        $this->vcardSent = $values['vcardSent'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
