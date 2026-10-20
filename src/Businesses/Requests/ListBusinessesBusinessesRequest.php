<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListBusinessesBusinessesRequest extends JsonSerializableType
{
    /**
     * @var ?string $status Filter by business status.
     */
    public ?string $status;

    /**
     * @var ?string $name Filter by legal name.
     */
    public ?string $name;

    /**
     * @var ?string $merchantCatCode Filter by merchant category code.
     */
    public ?string $merchantCatCode;

    /**
     * @var ?string $legalStructure Filter by legal structure.
     */
    public ?string $legalStructure;

    /**
     * @var ?int $limit Number of results per page.
     */
    public ?int $limit;

    /**
     * @var ?int $page Page number to return.
     */
    public ?int $page;

    /**
     * @var ?string $sortBy Field to sort by.
     */
    public ?string $sortBy;

    /**
     * @var ?string $sortOrder Sort direction.
     */
    public ?string $sortOrder;

    /**
     * @param array{
     *   status?: ?string,
     *   name?: ?string,
     *   merchantCatCode?: ?string,
     *   legalStructure?: ?string,
     *   limit?: ?int,
     *   page?: ?int,
     *   sortBy?: ?string,
     *   sortOrder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->merchantCatCode = $values['merchantCatCode'] ?? null;
        $this->legalStructure = $values['legalStructure'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
    }
}
