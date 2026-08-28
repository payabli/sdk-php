<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Bill to pay with this payout. Create the bill first with
 * [Add bill](/developers/api-reference/bill/add-bill), then reference it here
 * by `billId`.
 */
class RequestOutAuthorizeInvoiceData extends JsonSerializableType
{
    /**
     * @var int $billId
     */
    #[JsonProperty('billId')]
    public int $billId;

    /**
     * @param array{
     *   billId: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->billId = $values['billId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
