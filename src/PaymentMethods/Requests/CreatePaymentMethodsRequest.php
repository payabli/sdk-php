<?php

namespace Payabli\PaymentMethods\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\CreatePaymentMethodRequest;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class CreatePaymentMethodsRequest extends JsonSerializableType
{
    /**
     * @var array<CreatePaymentMethodRequest> $data The payment methods to create.
     */
    #[JsonProperty('data'), ArrayType([CreatePaymentMethodRequest::class])]
    public array $data;

    /**
     * @param array{
     *   data: array<CreatePaymentMethodRequest>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
    }
}
