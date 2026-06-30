<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Details of a completed outreach call that returned data.
 */
class VendorCallStatusCompleted extends JsonSerializableType
{
    /**
     * @var ?string $completedAt ISO-8601 timestamp when the call ended.
     */
    #[JsonProperty('completedAt')]
    public ?string $completedAt;

    /**
     * @var ?int $durationSeconds Call duration in seconds.
     */
    #[JsonProperty('durationSeconds')]
    public ?int $durationSeconds;

    /**
     * @var ?string $summary Short summary of the call.
     */
    #[JsonProperty('summary')]
    public ?string $summary;

    /**
     * @var ?string $callId Reference identifier for the call.
     */
    #[JsonProperty('callId')]
    public ?string $callId;

    /**
     * @var ?string $transcript Full call transcript. `null` when no transcript is available.
     */
    #[JsonProperty('transcript')]
    public ?string $transcript;

    /**
     * @var ?VendorCallStatusExtractedData $extractedData Payment and contact details collected during the call.
     */
    #[JsonProperty('extractedData')]
    public ?VendorCallStatusExtractedData $extractedData;

    /**
     * @param array{
     *   completedAt?: ?string,
     *   durationSeconds?: ?int,
     *   summary?: ?string,
     *   callId?: ?string,
     *   transcript?: ?string,
     *   extractedData?: ?VendorCallStatusExtractedData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->completedAt = $values['completedAt'] ?? null;
        $this->durationSeconds = $values['durationSeconds'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->callId = $values['callId'] ?? null;
        $this->transcript = $values['transcript'] ?? null;
        $this->extractedData = $values['extractedData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
