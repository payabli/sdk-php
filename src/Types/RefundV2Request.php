<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Optional request body for the v2 refund endpoints. Provide split instructions to refund a split-funded transaction. Omit the body for a standard refund. Fields match the v1 refund-with-instructions request.
 */
class RefundV2Request extends JsonSerializableType
{
    /**
     * Amount to refund from original transaction, minus any service fees charged on the original transaction.
     *
     * The amount provided can't be greater than the original total amount of the transaction, minus service fees. For example, if a transaction was $90 plus a $10 service fee, you can refund up to $90.
     *
     * An amount equal to zero will refund the total amount authorized minus any service fee.
     *
     * @var ?float $amount
     */
    #[JsonProperty('amount')]
    public ?float $amount;

    /**
     * @var ?string $ipaddress
     */
    #[JsonProperty('ipaddress')]
    public ?string $ipaddress;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var ?RefundDetail $refundDetails
     */
    #[JsonProperty('refundDetails')]
    public ?RefundDetail $refundDetails;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @param array{
     *   amount?: ?float,
     *   ipaddress?: ?string,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   refundDetails?: ?RefundDetail,
     *   source?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->amount = $values['amount'] ?? null;
        $this->ipaddress = $values['ipaddress'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->refundDetails = $values['refundDetails'] ?? null;
        $this->source = $values['source'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
