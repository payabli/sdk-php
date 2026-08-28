<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The required fields for a payment made with a semi-integrated device.
 */
class PayMethodDevice extends JsonSerializableType
{
    /**
     * Identifier of the registered semi-integrated device that takes the payment.
     * Omitting this field returns response code 7017, and an identifier that
     * isn't registered to the paypoint returns 7018.
     *
     * @var string $device
     */
    #[JsonProperty('device')]
    public string $device;

    /**
     * @var value-of<PayMethodDeviceMethod> $method Method to use for the transaction. For semi-integrated device transactions, the method is `device`.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var ?bool $saveIfSuccess
     */
    #[JsonProperty('saveIfSuccess')]
    public ?bool $saveIfSuccess;

    /**
     * @param array{
     *   device: string,
     *   method: value-of<PayMethodDeviceMethod>,
     *   saveIfSuccess?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->device = $values['device'];
        $this->method = $values['method'];
        $this->saveIfSuccess = $values['saveIfSuccess'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
