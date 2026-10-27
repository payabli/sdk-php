<?php

namespace Payabli\Organizations\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListOrganizationsOrganizationsRequest extends JsonSerializableType
{
    /**
     * @var ?string $businessReference Filter by the business the organization belongs to.
     */
    public ?string $businessReference;

    /**
     * @var ?string $status Filter by organization status. One of `active`, `inactive`, `suspended`, or `closed`. Any other value returns `400`.
     */
    public ?string $status;

    /**
     * @var ?string $search Free-text search across organizations.
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
