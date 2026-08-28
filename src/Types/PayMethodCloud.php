<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class PayMethodCloud extends JsonSerializableType
{
    /**
     * @var ?string $device
     */
    #[JsonProperty('device')]
    public ?string $device;

    /**
     * @var value-of<PayMethodCloudMethod> $method Method to use for the transaction. For cloud device transactions, the method is `cloud`.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @param array{
     *   method: value-of<PayMethodCloudMethod>,
     *   device?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->device = $values['device'] ?? null;
        $this->method = $values['method'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
