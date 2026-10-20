<?php

namespace Payabli\Paypoints\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListPaypointsPaypointsRequest extends JsonSerializableType
{
    /**
     * @var ?string $businessReference Filter by the business the paypoint belongs to.
     */
    public ?string $businessReference;

    /**
     * @var ?string $status Filter by paypoint status.
     */
    public ?string $status;

    /**
     * @var ?string $search Free-text search across paypoints.
     */
    public ?string $search;

    /**
     * @var ?int $limit Number of results per page.
     */
    public ?int $limit;

    /**
     * @var ?int $page Page number to return.
     */
    public ?int $page;

    /**
     * @param array{
     *   businessReference?: ?string,
     *   status?: ?string,
     *   search?: ?string,
     *   limit?: ?int,
     *   page?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->businessReference = $values['businessReference'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->search = $values['search'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->page = $values['page'] ?? null;
    }
}
