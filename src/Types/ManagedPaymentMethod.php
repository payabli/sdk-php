<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;

/**
 * Managed payment method for payables.
 */
class ManagedPaymentMethod extends JsonSerializableType
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
