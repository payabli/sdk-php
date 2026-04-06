<?php

namespace Payabli\GhostCard\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\GhostCard\Types\CardStatus;

class UpdateCardRequestBody extends JsonSerializableType
{
    /**
     * @var string $cardToken Token that uniquely identifies the card. This is the `ReferenceId` returned when the card was created.
     */
    #[JsonProperty('cardToken')]
    public string $cardToken;

    /**
     * @var ?value-of<CardStatus> $status The new status to set on the card.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @param array{
     *   cardToken: string,
     *   status?: ?value-of<CardStatus>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cardToken = $values['cardToken'];
        $this->status = $values['status'] ?? null;
    }
}
