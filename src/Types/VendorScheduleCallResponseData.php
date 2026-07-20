<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Scheduled call details.
 */
class VendorScheduleCallResponseData extends JsonSerializableType
{
    /**
     * @var ?int $callScheduleId Identifier for the scheduled call.
     */
    #[JsonProperty('callScheduleId')]
    public ?int $callScheduleId;

    /**
     * @var ?string $enrichmentId ID of the enrichment run associated with this call. When the request omits `enrichmentId`, Payabli generates one and returns it here.
     */
    #[JsonProperty('enrichmentId')]
    public ?string $enrichmentId;

    /**
     * @var ?string $scheduledCallDate ISO-8601 timestamp of the next scheduled call attempt.
     */
    #[JsonProperty('scheduledCallDate')]
    public ?string $scheduledCallDate;

    /**
     * @var ?string $status Status of the call schedule. Values are `pending`, `dispatched`, `retry_scheduled`, `completed`, and `fallback_applied`.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @param array{
     *   callScheduleId?: ?int,
     *   enrichmentId?: ?string,
     *   scheduledCallDate?: ?string,
     *   status?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->callScheduleId = $values['callScheduleId'] ?? null;
        $this->enrichmentId = $values['enrichmentId'] ?? null;
        $this->scheduledCallDate = $values['scheduledCallDate'] ?? null;
        $this->status = $values['status'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
