<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListMessagesCaseManagementRequest extends JsonSerializableType
{
    /**
     * @var ?int $limit The maximum number of notes to return (default 50, max 200).
     */
    public ?int $limit;

    /**
     * @var ?string $cursor An opaque cursor for the next page.
     */
    public ?string $cursor;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }
}
