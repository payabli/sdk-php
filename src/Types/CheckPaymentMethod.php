<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;

/**
 * Check payment method.
 */
class CheckPaymentMethod extends JsonSerializableType
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
