<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Check data for an outbound transfer detail.
 */
class TransferOutDetailCheckData extends JsonSerializableType
{
    /**
     * @var ?string $checkNumber The check number.
     */
    #[JsonProperty('CheckNumber')]
    public ?string $checkNumber;

    /**
     * @var ?string $checkData Additional check data.
     */
    #[JsonProperty('CheckData')]
    public ?string $checkData;

    /**
     * @param array{
     *   checkNumber?: ?string,
     *   checkData?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->checkData = $values['checkData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
