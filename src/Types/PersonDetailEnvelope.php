<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Standard boarding response envelope wrapping a person detail.
 */
class PersonDetailEnvelope extends JsonSerializableType
{
    /**
     * @var bool $success Whether the request succeeded.
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var ?string $message A human-readable result message.
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @var ?string $traceId The trace identifier for the request, useful for support.
     */
    #[JsonProperty('traceId')]
    public ?string $traceId;

    /**
     * @var ?PersonDetailResponse $data The person detail.
     */
    #[JsonProperty('data')]
    public ?PersonDetailResponse $data;

    /**
     * @var ?array<BoardingWarning> $warnings Non-blocking warnings, such as a business link that didn't complete.
     */
    #[JsonProperty('warnings'), ArrayType([BoardingWarning::class])]
    public ?array $warnings;

    /**
     * @param array{
     *   success: bool,
     *   message?: ?string,
     *   traceId?: ?string,
     *   data?: ?PersonDetailResponse,
     *   warnings?: ?array<BoardingWarning>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->message = $values['message'] ?? null;
        $this->traceId = $values['traceId'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->warnings = $values['warnings'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
