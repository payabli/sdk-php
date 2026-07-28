<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Case metadata, populated as the case progresses. Null until verification completes.
 */
class CaseMetadata extends JsonSerializableType
{
    /**
     * @var ?BankVerificationMetadata $verification The verification outcome. Null until verification finishes.
     */
    #[JsonProperty('verification')]
    public ?BankVerificationMetadata $verification;

    /**
     * @var ?ReviewDecisionMetadata $reviewDecision The reviewer's decision, when one has been made.
     */
    #[JsonProperty('reviewDecision')]
    public ?ReviewDecisionMetadata $reviewDecision;

    /**
     * @param array{
     *   verification?: ?BankVerificationMetadata,
     *   reviewDecision?: ?ReviewDecisionMetadata,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->verification = $values['verification'] ?? null;
        $this->reviewDecision = $values['reviewDecision'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
