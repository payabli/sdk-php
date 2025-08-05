<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class PayabliApiResponse11ResponseData extends JsonSerializableType
{
    /**
     * @var ?int $customerId Payabli-generated unique ID of vendor owner of transaction. It will return `0`` if the transaction wasn't assigned to an existing vendor or no vendor was created.
     */
    #[JsonProperty('CustomerId')]
    public ?int $customerId;

    /**
     * @var ?string $referenceId
     */
    #[JsonProperty('ReferenceId')]
    public ?string $referenceId;

    /**
     * @var ?int $resultCode
     */
    #[JsonProperty('ResultCode')]
    public ?int $resultCode;

    /**
     * @var ?string $resultText Text describing the result. If **ResultCode** = 1, will return 'Authorized'. If **ResultCode** = 2 or 3, will contain the reason for the decline.
     */
    #[JsonProperty('ResultText')]
    public ?string $resultText;

    /**
     * @param array{
     *   customerId?: ?int,
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->customerId = $values['customerId'] ?? null;
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
