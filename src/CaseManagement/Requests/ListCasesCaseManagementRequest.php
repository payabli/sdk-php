<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListCasesCaseManagementRequest extends JsonSerializableType
{
    /**
     * @var ?int $fromRecord The zero-based index of the first record to return.
     */
    public ?int $fromRecord;

    /**
     * @var ?int $limitRecord The maximum number of records to return (1 to 200).
     */
    public ?int $limitRecord;

    /**
     * @var ?string $sortBy Sort expression, such as `desc(createdAt)` or `asc(state)`. Defaults to `desc(createdAt)`.
     */
    public ?string $sortBy;

    /**
     * @param array{
     *   fromRecord?: ?int,
     *   limitRecord?: ?int,
     *   sortBy?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fromRecord = $values['fromRecord'] ?? null;
        $this->limitRecord = $values['limitRecord'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
    }
}
