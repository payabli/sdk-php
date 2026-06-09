<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class CreateApplicationFromPaypointResponseData extends JsonSerializableType
{
    /**
     * @var ?int $appId Unique identifier for the created application.
     */
    #[JsonProperty('appId')]
    public ?int $appId;

    /**
     * @var ?string $boardingLink URL where the merchant can complete the boarding process.
     */
    #[JsonProperty('boardingLink')]
    public ?string $boardingLink;

    /**
     * @param array{
     *   appId?: ?int,
     *   boardingLink?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->appId = $values['appId'] ?? null;
        $this->boardingLink = $values['boardingLink'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
