<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListApplicationsApplicationsRequest extends JsonSerializableType
{
    /**
     * @var ?int $page The page number to return, starting at 1.
     */
    public ?int $page;

    /**
     * @var ?int $limit The number of applications per page.
     */
    public ?int $limit;

    /**
     * @param array{
     *   page?: ?int,
     *   limit?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->limit = $values['limit'] ?? null;
    }
}
