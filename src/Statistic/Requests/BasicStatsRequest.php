<?php

namespace Payabli\Statistic\Requests;

use Payabli\Core\Json\JsonSerializableType;

class BasicStatsRequest extends JsonSerializableType
{
    /**
     * Used with `custom` mode. The end date for the range.
     * Valid formats:
     *   - YYYY-mm-dd
     *   - YYYY/mm/dd
     *   - mm-dd-YYYY
     *   - mm/dd/YYYY
     *
     * @var ?string $endDate
     */
    public ?string $endDate;

    /**
     * Used with `custom` mode. The start date for the range.
     * Valid formats:
     *    - YYYY-mm-dd
     *    - YYYY/mm/dd
     *    -  mm-dd-YYYY
     *    - mm/dd/YYYY
     *
     * @var ?string $startDate
     */
    public ?string $startDate;

    /**
     * @param array{
     *   endDate?: ?string,
     *   startDate?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->endDate = $values['endDate'] ?? null;
        $this->startDate = $values['startDate'] ?? null;
    }
}
