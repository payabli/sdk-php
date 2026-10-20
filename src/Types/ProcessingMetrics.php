<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Expected Pay In processing profile for the business.
 */
class ProcessingMetrics extends JsonSerializableType
{
    /**
     * @var ?float $monthlyReceivablesVolume Expected monthly Pay In volume.
     */
    #[JsonProperty('monthlyReceivablesVolume')]
    public ?float $monthlyReceivablesVolume;

    /**
     * @var ?float $averageReceivableSize Expected average transaction amount.
     */
    #[JsonProperty('averageReceivableSize')]
    public ?float $averageReceivableSize;

    /**
     * @var ?float $largestReceivableSize Expected largest transaction amount.
     */
    #[JsonProperty('largestReceivableSize')]
    public ?float $largestReceivableSize;

    /**
     * @var ?int $inboundPresentPercent Percent of volume from card-present transactions.
     */
    #[JsonProperty('inboundPresentPercent')]
    public ?int $inboundPresentPercent;

    /**
     * @var ?int $inboundOnlinePercent Percent of volume from online transactions.
     */
    #[JsonProperty('inboundOnlinePercent')]
    public ?int $inboundOnlinePercent;

    /**
     * @var ?int $inboundMotoPercent Percent of volume from mail-order/telephone-order transactions.
     */
    #[JsonProperty('inboundMotoPercent')]
    public ?int $inboundMotoPercent;

    /**
     * @var ?string $refundPolicy The business's refund policy.
     */
    #[JsonProperty('refundPolicy')]
    public ?string $refundPolicy;

    /**
     * @var ?bool $advancedDelivery Whether the business delivers goods or services before it's paid.
     */
    #[JsonProperty('advancedDelivery')]
    public ?bool $advancedDelivery;

    /**
     * @var ?int $percentAdvancedDelivery Percent of sales delivered before payment.
     */
    #[JsonProperty('percentAdvancedDelivery')]
    public ?int $percentAdvancedDelivery;

    /**
     * @var ?float $advancedDeliveryDays Average number of days between payment and delivery.
     */
    #[JsonProperty('advancedDeliveryDays')]
    public ?float $advancedDeliveryDays;

    /**
     * @var ?int $numberOfTransactions Expected number of transactions per month.
     */
    #[JsonProperty('numberOfTransactions')]
    public ?int $numberOfTransactions;

    /**
     * @param array{
     *   monthlyReceivablesVolume?: ?float,
     *   averageReceivableSize?: ?float,
     *   largestReceivableSize?: ?float,
     *   inboundPresentPercent?: ?int,
     *   inboundOnlinePercent?: ?int,
     *   inboundMotoPercent?: ?int,
     *   refundPolicy?: ?string,
     *   advancedDelivery?: ?bool,
     *   percentAdvancedDelivery?: ?int,
     *   advancedDeliveryDays?: ?float,
     *   numberOfTransactions?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->monthlyReceivablesVolume = $values['monthlyReceivablesVolume'] ?? null;
        $this->averageReceivableSize = $values['averageReceivableSize'] ?? null;
        $this->largestReceivableSize = $values['largestReceivableSize'] ?? null;
        $this->inboundPresentPercent = $values['inboundPresentPercent'] ?? null;
        $this->inboundOnlinePercent = $values['inboundOnlinePercent'] ?? null;
        $this->inboundMotoPercent = $values['inboundMotoPercent'] ?? null;
        $this->refundPolicy = $values['refundPolicy'] ?? null;
        $this->advancedDelivery = $values['advancedDelivery'] ?? null;
        $this->percentAdvancedDelivery = $values['percentAdvancedDelivery'] ?? null;
        $this->advancedDeliveryDays = $values['advancedDeliveryDays'] ?? null;
        $this->numberOfTransactions = $values['numberOfTransactions'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
