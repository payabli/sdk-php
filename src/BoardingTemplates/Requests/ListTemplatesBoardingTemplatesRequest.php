<?php

namespace Payabli\BoardingTemplates\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\TemplateStatus;

class ListTemplatesBoardingTemplatesRequest extends JsonSerializableType
{
    /**
     * @var int $orgId The numeric identifier of the organization to list templates for.
     */
    public int $orgId;

    /**
     * @var ?value-of<TemplateStatus> $status Filter by template status.
     */
    public ?string $status;

    /**
     * @var ?string $name Filter by exact template name.
     */
    public ?string $name;

    /**
     * @var ?string $slug Filter by exact template slug.
     */
    public ?string $slug;

    /**
     * @var ?string $orgName Filter by exact owning organization name.
     */
    public ?string $orgName;

    /**
     * @var ?bool $inherited Filter by whether the template is inherited from an ancestor organization.
     */
    public ?bool $inherited;

    /**
     * @var ?int $fromRecord The number of records to skip before collecting the result set.
     */
    public ?int $fromRecord;

    /**
     * @var ?int $limitRecord The maximum number of records to return. Use `0` or a negative value to return all records.
     */
    public ?int $limitRecord;

    /**
     * @param array{
     *   orgId: int,
     *   status?: ?value-of<TemplateStatus>,
     *   name?: ?string,
     *   slug?: ?string,
     *   orgName?: ?string,
     *   inherited?: ?bool,
     *   fromRecord?: ?int,
     *   limitRecord?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->orgId = $values['orgId'];
        $this->status = $values['status'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->slug = $values['slug'] ?? null;
        $this->orgName = $values['orgName'] ?? null;
        $this->inherited = $values['inherited'] ?? null;
        $this->fromRecord = $values['fromRecord'] ?? null;
        $this->limitRecord = $values['limitRecord'] ?? null;
    }
}
