<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\CaseTrigger;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BankReviewDecisionReason;

class TransitionCaseRequest extends JsonSerializableType
{
    /**
     * @var value-of<CaseTrigger> $trigger
     */
    #[JsonProperty('trigger')]
    public string $trigger;

    /**
     * @var string $reason The reason for the action.
     */
    #[JsonProperty('reason')]
    public string $reason;

    /**
     * @var ?value-of<BankReviewDecisionReason> $declineReason The decline reason. Required when the trigger is `Deny`, and must be omitted otherwise.
     */
    #[JsonProperty('declineReason')]
    public ?string $declineReason;

    /**
     * @param array{
     *   trigger: value-of<CaseTrigger>,
     *   reason: string,
     *   declineReason?: ?value-of<BankReviewDecisionReason>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->trigger = $values['trigger'];
        $this->reason = $values['reason'];
        $this->declineReason = $values['declineReason'] ?? null;
    }
}
