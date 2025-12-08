<?php

namespace Payabli\Statistic\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class StatBasicExtendedQueryRecord extends JsonSerializableType
{
    /**
     * @var string $statX The time window based on the mode and frequency used for the query.
     */
    #[JsonProperty('statX')]
    public string $statX;

    /**
     * @var int $outCustomers Number of active vendors.
     */
    #[JsonProperty('outCustomers')]
    public int $outCustomers;

    /**
     * @var int $outNewCustomers Number of new vendors.
     */
    #[JsonProperty('outNewCustomers')]
    public int $outNewCustomers;

    /**
     * @var int $outTransactions Outbound (payout) transactions count.
     */
    #[JsonProperty('outTransactions')]
    public int $outTransactions;

    /**
     * @var int $outSubscriptionsPaid Recurring outbound (payout) transactions count.
     */
    #[JsonProperty('outSubscriptionsPaid')]
    public int $outSubscriptionsPaid;

    /**
     * @var int $outCardTransactions Outbound (payout) pCard transactions count.
     */
    #[JsonProperty('outCardTransactions')]
    public int $outCardTransactions;

    /**
     * @var int $outVCardTransactions Outbound (payout) vCard transactions count.
     */
    #[JsonProperty('outVCardTransactions')]
    public int $outVCardTransactions;

    /**
     * @var int $outAchTransactions Outbound (payout) ACH transactions count.
     */
    #[JsonProperty('outACHTransactions')]
    public int $outAchTransactions;

    /**
     * @var int $outCheckTransactions Outbound (payout) check transactions count.
     */
    #[JsonProperty('outCheckTransactions')]
    public int $outCheckTransactions;

    /**
     * @var int $outPendingMethodTransactions Outbound (payout) Managed Payables transactions count.
     */
    #[JsonProperty('outPendingMethodTransactions')]
    public int $outPendingMethodTransactions;

    /**
     * @var float $outTransactionsVolume Outbound (payout) volume.
     */
    #[JsonProperty('outTransactionsVolume')]
    public float $outTransactionsVolume;

    /**
     * @var float $outSubscriptionsPaidVolume Recurring outbound (payout) volume.
     */
    #[JsonProperty('outSubscriptionsPaidVolume')]
    public float $outSubscriptionsPaidVolume;

    /**
     * @var float $outCardVolume Outbound (payout) pCard transactions volume.
     */
    #[JsonProperty('outCardVolume')]
    public float $outCardVolume;

    /**
     * @var float $outVCardVolume Outbound (payout) vCard transactions volume.
     */
    #[JsonProperty('outVCardVolume')]
    public float $outVCardVolume;

    /**
     * @var float $outAchVolume Outbound (payout) ACH transactions volume.
     */
    #[JsonProperty('outACHVolume')]
    public float $outAchVolume;

    /**
     * @var float $outCheckVolume Outbound (payout) check transactions volume.
     */
    #[JsonProperty('outCheckVolume')]
    public float $outCheckVolume;

    /**
     * @var float $outPendingMethodVolume Outbound (payout) Managed Payables volume.
     */
    #[JsonProperty('outPendingMethodVolume')]
    public float $outPendingMethodVolume;

    /**
     * @var int $inTransactions Inbound transactions count.
     */
    #[JsonProperty('inTransactions')]
    public int $inTransactions;

    /**
     * @var int $inSubscriptionsPaid Inbound recurring transactions count.
     */
    #[JsonProperty('inSubscriptionsPaid')]
    public int $inSubscriptionsPaid;

    /**
     * @var int $inCustomers Number of active customers.
     */
    #[JsonProperty('inCustomers')]
    public int $inCustomers;

    /**
     * @var int $inNewCustomers Number of new customers.
     */
    #[JsonProperty('inNewCustomers')]
    public int $inNewCustomers;

    /**
     * @var int $inCardTransactions Inbound card transactions count.
     */
    #[JsonProperty('inCardTransactions')]
    public int $inCardTransactions;

    /**
     * @var int $inAchTransactions Inbound ACH transactions count.
     */
    #[JsonProperty('inACHTransactions')]
    public int $inAchTransactions;

    /**
     * @var int $inCheckTransactions Inbound check transactions count.
     */
    #[JsonProperty('inCheckTransactions')]
    public int $inCheckTransactions;

    /**
     * @var int $inCashTransactions Inbound cash transactions count.
     */
    #[JsonProperty('inCashTransactions')]
    public int $inCashTransactions;

    /**
     * @var int $inWalletTransactions Inbound wallet transactions count.
     */
    #[JsonProperty('inWalletTransactions')]
    public int $inWalletTransactions;

    /**
     * @var int $inCardChargeBacks Inbound card chargebacks and returns count.
     */
    #[JsonProperty('inCardChargeBacks')]
    public int $inCardChargeBacks;

    /**
     * @var int $inAchReturns Inbound ACH returns count.
     */
    #[JsonProperty('inACHReturns')]
    public int $inAchReturns;

    /**
     * @var float $inTransactionsVolume Inbound volume.
     */
    #[JsonProperty('inTransactionsVolume')]
    public float $inTransactionsVolume;

    /**
     * @var float $inSubscriptionsPaidVolume Inbound recurring payments volume.
     */
    #[JsonProperty('inSubscriptionsPaidVolume')]
    public float $inSubscriptionsPaidVolume;

    /**
     * @var float $inCardVolume Inbound card volume.
     */
    #[JsonProperty('inCardVolume')]
    public float $inCardVolume;

    /**
     * @var float $inAchVolume Inbound ACH volume.
     */
    #[JsonProperty('inACHVolume')]
    public float $inAchVolume;

    /**
     * @var float $inCheckVolume Inbound check volume.
     */
    #[JsonProperty('inCheckVolume')]
    public float $inCheckVolume;

    /**
     * @var float $inCashVolume Inbound cash volume recognized.
     */
    #[JsonProperty('inCashVolume')]
    public float $inCashVolume;

    /**
     * @var float $inWalletVolume Inbound wallet transactions.
     */
    #[JsonProperty('inWalletVolume')]
    public float $inWalletVolume;

    /**
     * @var float $inCardChargeBackVolume Inbound Card chargebacks and returns volume.
     */
    #[JsonProperty('inCardChargeBackVolume')]
    public float $inCardChargeBackVolume;

    /**
     * @var float $inAchReturnsVolume Inbound ACH returns volume.
     */
    #[JsonProperty('inACHReturnsVolume')]
    public float $inAchReturnsVolume;

    /**
     * @param array{
     *   statX: string,
     *   outCustomers: int,
     *   outNewCustomers: int,
     *   outTransactions: int,
     *   outSubscriptionsPaid: int,
     *   outCardTransactions: int,
     *   outVCardTransactions: int,
     *   outAchTransactions: int,
     *   outCheckTransactions: int,
     *   outPendingMethodTransactions: int,
     *   outTransactionsVolume: float,
     *   outSubscriptionsPaidVolume: float,
     *   outCardVolume: float,
     *   outVCardVolume: float,
     *   outAchVolume: float,
     *   outCheckVolume: float,
     *   outPendingMethodVolume: float,
     *   inTransactions: int,
     *   inSubscriptionsPaid: int,
     *   inCustomers: int,
     *   inNewCustomers: int,
     *   inCardTransactions: int,
     *   inAchTransactions: int,
     *   inCheckTransactions: int,
     *   inCashTransactions: int,
     *   inWalletTransactions: int,
     *   inCardChargeBacks: int,
     *   inAchReturns: int,
     *   inTransactionsVolume: float,
     *   inSubscriptionsPaidVolume: float,
     *   inCardVolume: float,
     *   inAchVolume: float,
     *   inCheckVolume: float,
     *   inCashVolume: float,
     *   inWalletVolume: float,
     *   inCardChargeBackVolume: float,
     *   inAchReturnsVolume: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->statX = $values['statX'];
        $this->outCustomers = $values['outCustomers'];
        $this->outNewCustomers = $values['outNewCustomers'];
        $this->outTransactions = $values['outTransactions'];
        $this->outSubscriptionsPaid = $values['outSubscriptionsPaid'];
        $this->outCardTransactions = $values['outCardTransactions'];
        $this->outVCardTransactions = $values['outVCardTransactions'];
        $this->outAchTransactions = $values['outAchTransactions'];
        $this->outCheckTransactions = $values['outCheckTransactions'];
        $this->outPendingMethodTransactions = $values['outPendingMethodTransactions'];
        $this->outTransactionsVolume = $values['outTransactionsVolume'];
        $this->outSubscriptionsPaidVolume = $values['outSubscriptionsPaidVolume'];
        $this->outCardVolume = $values['outCardVolume'];
        $this->outVCardVolume = $values['outVCardVolume'];
        $this->outAchVolume = $values['outAchVolume'];
        $this->outCheckVolume = $values['outCheckVolume'];
        $this->outPendingMethodVolume = $values['outPendingMethodVolume'];
        $this->inTransactions = $values['inTransactions'];
        $this->inSubscriptionsPaid = $values['inSubscriptionsPaid'];
        $this->inCustomers = $values['inCustomers'];
        $this->inNewCustomers = $values['inNewCustomers'];
        $this->inCardTransactions = $values['inCardTransactions'];
        $this->inAchTransactions = $values['inAchTransactions'];
        $this->inCheckTransactions = $values['inCheckTransactions'];
        $this->inCashTransactions = $values['inCashTransactions'];
        $this->inWalletTransactions = $values['inWalletTransactions'];
        $this->inCardChargeBacks = $values['inCardChargeBacks'];
        $this->inAchReturns = $values['inAchReturns'];
        $this->inTransactionsVolume = $values['inTransactionsVolume'];
        $this->inSubscriptionsPaidVolume = $values['inSubscriptionsPaidVolume'];
        $this->inCardVolume = $values['inCardVolume'];
        $this->inAchVolume = $values['inAchVolume'];
        $this->inCheckVolume = $values['inCheckVolume'];
        $this->inCashVolume = $values['inCashVolume'];
        $this->inWalletVolume = $values['inWalletVolume'];
        $this->inCardChargeBackVolume = $values['inCardChargeBackVolume'];
        $this->inAchReturnsVolume = $values['inAchReturnsVolume'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
