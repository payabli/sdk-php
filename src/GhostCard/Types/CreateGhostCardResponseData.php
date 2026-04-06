<?php

namespace Payabli\GhostCard\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class CreateGhostCardResponseData extends JsonSerializableType
{
    /**
     * @var ?string $referenceId Card token for the ghost card. Use this value to reference the card in subsequent operations (update, cancel, etc.).
     */
    #[JsonProperty('ReferenceId')]
    public ?string $referenceId;

    /**
     * @var ?int $resultCode
     */
    #[JsonProperty('ResultCode')]
    public ?int $resultCode;

    /**
     * @var ?string $resultText
     */
    #[JsonProperty('ResultText')]
    public ?string $resultText;

    /**
     * @param array{
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->referenceId = $values['referenceId'] ?? null;
        $this->resultCode = $values['resultCode'] ?? null;
        $this->resultText = $values['resultText'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
