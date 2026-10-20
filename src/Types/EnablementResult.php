<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The progress of setting up an approved application's services with their processors.
 */
class EnablementResult extends JsonSerializableType
{
    /**
     * @var string $requestsReference The application reference.
     */
    #[JsonProperty('requestsReference')]
    public string $requestsReference;

    /**
     * The overall enablement state. `null` when enablement hasn't started. One of:
     *
     * - `Submitted`: Enablement is in progress.
     * - `Activated`: Every service is `Provisioned`.
     * - `Failed`: Enablement stopped and isn't retried.
     *
     * @var ?string $state
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var array<EnablementService> $services The enablement progress of each requested service. Empty when enablement hasn't started.
     */
    #[JsonProperty('services'), ArrayType([EnablementService::class])]
    public array $services;

    /**
     * Why enablement isn't moving. `null` when nothing is blocking it, or when enablement hasn't started. One of:
     *
     * - `processor`: At least one service is waiting on its processor, for example during an outage or the processor's review. Payabli retries automatically.
     * - `merchant_data`: Something about the merchant needs a correction, such as fields the processor refused or a missing tax ID. Check `missingFields` on each service.
     * - `platform_configuration`: Waiting on configuration that Payabli maintains. The merchant doesn't need to act.
     * - `enablement_failed`: Enablement stopped and isn't retried. `services` shows which service stopped.
     * - `unclassified`: Enablement isn't complete, and the cause isn't determined yet.
     *
     * @var ?string $blockedOn
     */
    #[JsonProperty('blockedOn')]
    public ?string $blockedOn;

    /**
     * @var ?string $message A sentence that explains `blockedOn`. From the second attempt on, it includes the number of attempts.
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @var ?int $attempts How many times Payabli has attempted enablement. `null` when enablement hasn't started.
     */
    #[JsonProperty('attempts')]
    public ?int $attempts;

    /**
     * @var ?DateTime $firstAttemptAt When Payabli first attempted enablement.
     */
    #[JsonProperty('firstAttemptAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $firstAttemptAt;

    /**
     * @var ?DateTime $lastAttemptAt When Payabli most recently attempted enablement.
     */
    #[JsonProperty('lastAttemptAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastAttemptAt;

    /**
     * @param array{
     *   requestsReference: string,
     *   services: array<EnablementService>,
     *   state?: ?string,
     *   blockedOn?: ?string,
     *   message?: ?string,
     *   attempts?: ?int,
     *   firstAttemptAt?: ?DateTime,
     *   lastAttemptAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requestsReference = $values['requestsReference'];
        $this->state = $values['state'] ?? null;
        $this->services = $values['services'];
        $this->blockedOn = $values['blockedOn'] ?? null;
        $this->message = $values['message'] ?? null;
        $this->attempts = $values['attempts'] ?? null;
        $this->firstAttemptAt = $values['firstAttemptAt'] ?? null;
        $this->lastAttemptAt = $values['lastAttemptAt'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
