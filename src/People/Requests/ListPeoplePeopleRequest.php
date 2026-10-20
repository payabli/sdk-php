<?php

namespace Payabli\People\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListPeoplePeopleRequest extends JsonSerializableType
{
    /**
     * @var ?string $name Filter by name (partial match).
     */
    public ?string $name;

    /**
     * @var ?string $email Filter by email (partial match).
     */
    public ?string $email;

    /**
     * @var ?string $verificationStatus Comma-separated verification status filter.
     */
    public ?string $verificationStatus;

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
     *   name?: ?string,
     *   email?: ?string,
     *   verificationStatus?: ?string,
     *   limit?: ?int,
     *   page?: ?int,
     *   sortBy?: ?string,
     *   sortOrder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->verificationStatus = $values['verificationStatus'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
    }
}
