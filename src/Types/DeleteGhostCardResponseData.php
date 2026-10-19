<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DeleteGhostCardResponseData extends JsonSerializableType
{
    /**
     * @var ?string $deleteType The type of delete performed. Always `soft`, because Payabli keeps the card record.
     */
    #[JsonProperty('deleteType')]
    public ?string $deleteType;

    /**
     * @var ?string $cardToken Token of the canceled ghost card.
     */
    #[JsonProperty('cardToken')]
    public ?string $cardToken;

    /**
     * @param array{
     *   deleteType?: ?string,
     *   cardToken?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->deleteType = $values['deleteType'] ?? null;
        $this->cardToken = $values['cardToken'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
