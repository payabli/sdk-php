<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;

/**
 * Virtual card payment method.
 */
class VCardPaymentMethod extends JsonSerializableType
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
