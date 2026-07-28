<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Details of a reviewer's decision, when one has been made.
 */
class ReviewDecisionMetadata extends JsonSerializableType
{
    /**
     * @var ?value-of<BankReviewDecisionReason> $declineReason The decline reason, when the case was denied.
     */
    #[JsonProperty('declineReason')]
    public ?string $declineReason;

    /**
     * @var ?string $note A free-text note attached to the decision.
     */
    #[JsonProperty('note')]
    public ?string $note;

    /**
     * @param array{
     *   declineReason?: ?value-of<BankReviewDecisionReason>,
     *   note?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->declineReason = $values['declineReason'] ?? null;
        $this->note = $values['note'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
