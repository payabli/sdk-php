<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Error response from the token endpoint when the request is invalid, for example when the client credentials are wrong.
 */
class TokenErrorResponse extends JsonSerializableType
{
    /**
     * @var string $errorType The error category, for example `InvalidCredentials`.
     */
    #[JsonProperty('errorType')]
    public string $errorType;

    /**
     * @var string $errorMessage A human-readable error description.
     */
    #[JsonProperty('errorMessage')]
    public string $errorMessage;

    /**
     * @param array{
     *   errorType: string,
     *   errorMessage: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->errorType = $values['errorType'];
        $this->errorMessage = $values['errorMessage'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
