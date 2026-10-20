<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A page of payment methods.
 */
class ListPaymentMethodsResponse extends JsonSerializableType
{
    /**
     * @var ?array<PaymentMethodDetail> $data The payment methods on this page.
     */
    #[JsonProperty('data'), ArrayType([PaymentMethodDetail::class])]
    public ?array $data;

    /**
     * @var ?Pagination $pagination Pagination metadata.
     */
    #[JsonProperty('pagination')]
    public ?Pagination $pagination;

    /**
     * @param array{
     *   data?: ?array<PaymentMethodDetail>,
     *   pagination?: ?Pagination,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->data = $values['data'] ?? null;
        $this->pagination = $values['pagination'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
