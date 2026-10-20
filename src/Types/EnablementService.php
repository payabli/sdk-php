<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The enablement progress of one service the application requested.
 */
class EnablementService extends JsonSerializableType
{
    /**
     * @var string $service The service, such as `Card`.
     */
    #[JsonProperty('service')]
    public string $service;

    /**
     * @var string $rail Whether the service moves money in (`MoneyIn`) or out (`MoneyOut`).
     */
    #[JsonProperty('rail')]
    public string $rail;

    /**
     * The service's enablement state. One of:
     *
     * - `Pending`: Not sent to the processor yet.
     * - `Submitted`: Sent to the processor, waiting for a response.
     * - `Approved`: The processor approved the service.
     * - `Provisioned`: The service is set up and ready to use.
     * - `HeldForInput`: Needs a correction or more information. Enablement resumes after someone acts.
     * - `Failed`: Enablement failed for this service.
     *
     * @var string $state
     */
    #[JsonProperty('state')]
    public string $state;

    /**
     * @var ?string $message A sentence about the service when its last attempt didn't go through, or when it failed. When the processor refused fields or reported them as missing, the sentence names them. `null` otherwise.
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @var ?array<string> $missingFields The boarding API fields the processor refused or reported as missing, such as `addresses.cityLocality`. `null` when the processor named none.
     */
    #[JsonProperty('missingFields'), ArrayType(['string'])]
    public ?array $missingFields;

    /**
     * @param array{
     *   service: string,
     *   rail: string,
     *   state: string,
     *   message?: ?string,
     *   missingFields?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->service = $values['service'];
        $this->rail = $values['rail'];
        $this->state = $values['state'];
        $this->message = $values['message'] ?? null;
        $this->missingFields = $values['missingFields'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
