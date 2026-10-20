<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The error body when an application can't be submitted.
 */
class SubmitApplicationError extends JsonSerializableType
{
    /**
     * @var bool $success Whether the request succeeded. Always `false`.
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var string $error The error code, such as `VALIDATION_ERROR`, `SIGNER_REQUIRED`, or `SIGNER_NOT_OWNER`.
     */
    #[JsonProperty('error')]
    public string $error;

    /**
     * @var string $message A human-readable description of the error.
     */
    #[JsonProperty('message')]
    public string $message;

    /**
     * @var ?string $traceId The trace identifier for the request, useful for support.
     */
    #[JsonProperty('traceId')]
    public ?string $traceId;

    /**
     * @param array{
     *   success: bool,
     *   error: string,
     *   message: string,
     *   traceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->error = $values['error'];
        $this->message = $values['message'];
        $this->traceId = $values['traceId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
