<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class WithdrawApplicationRequest extends JsonSerializableType
{
    /**
     * @var ?string $reason An optional reason for the withdrawal, recorded in the status history.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @param array{
     *   reason?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->reason = $values['reason'] ?? null;
    }
}
