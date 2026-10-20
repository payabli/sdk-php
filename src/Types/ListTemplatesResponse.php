<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A page of boarding templates.
 */
class ListTemplatesResponse extends JsonSerializableType
{
    /**
     * @var TemplatesSummary $summary Pagination metadata for the result set.
     */
    #[JsonProperty('Summary')]
    public TemplatesSummary $summary;

    /**
     * @var array<Template> $records The templates on this page.
     */
    #[JsonProperty('Records'), ArrayType([Template::class])]
    public array $records;

    /**
     * @param array{
     *   summary: TemplatesSummary,
     *   records: array<Template>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->summary = $values['summary'];
        $this->records = $values['records'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
