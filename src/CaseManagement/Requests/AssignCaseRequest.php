<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class AssignCaseRequest extends JsonSerializableType
{
    /**
     * @var int $assigneeId The numeric id of the reviewer to assign the case to.
     */
    #[JsonProperty('assigneeId')]
    public int $assigneeId;

    /**
     * @var ?string $reason An optional reason for the assignment.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @param array{
     *   assigneeId: int,
     *   reason?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->assigneeId = $values['assigneeId'];
        $this->reason = $values['reason'] ?? null;
    }
}
