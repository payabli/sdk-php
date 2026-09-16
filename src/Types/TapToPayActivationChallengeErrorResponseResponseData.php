<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class TapToPayActivationChallengeErrorResponseResponseData extends JsonSerializableType
{
    /**
     * @var int $resultCode The same status code as the HTTP response.
     */
    #[JsonProperty('resultCode')]
    public int $resultCode;

    /**
     * @var string $resultText A message describing why the request was refused.
     */
    #[JsonProperty('resultText')]
    public string $resultText;

    /**
     * @param array{
     *   resultCode: int,
     *   resultText: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resultCode = $values['resultCode'];
        $this->resultText = $values['resultText'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
