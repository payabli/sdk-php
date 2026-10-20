<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DeactivateBusinessRequest extends JsonSerializableType
{
    /**
     * @var ?string $reason Optional reason for deactivation (max 500 characters).
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
