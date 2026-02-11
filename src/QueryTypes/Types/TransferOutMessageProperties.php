<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Properties associated with a transfer message.
 */
class TransferOutMessageProperties extends JsonSerializableType
{
    /**
     * @var ?string $originalTransferStatus The original status of the transfer before the message.
     */
    #[JsonProperty('originalTransferStatus')]
    public ?string $originalTransferStatus;

    /**
     * @var ?string $currentTransferStatus The current status of the transfer after the message.
     */
    #[JsonProperty('currentTransferStatus')]
    public ?string $currentTransferStatus;

    /**
     * @param array{
     *   originalTransferStatus?: ?string,
     *   currentTransferStatus?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->originalTransferStatus = $values['originalTransferStatus'] ?? null;
        $this->currentTransferStatus = $values['currentTransferStatus'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
