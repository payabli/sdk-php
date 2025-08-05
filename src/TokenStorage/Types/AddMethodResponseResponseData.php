<?php

namespace Payabli\TokenStorage\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class AddMethodResponseResponseData extends JsonSerializableType
{
    /**
     * Internal unique ID of customer owner of the stored method.
     *
     * Returns `0` if the method wasn't assigned to an existing customer or no customer was created."
     *
     * @var ?int $customerId
     */
    #[JsonProperty('CustomerId')]
    public ?int $customerId;

    /**
     * @var ?string $methodReferenceId
     */
    #[JsonProperty('methodReferenceId')]
    public ?string $methodReferenceId;

    /**
     * @var ?string $referenceId Stored method identifier in Payabli platform. This ID is used to manage the stored method.
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
     *   customerId?: ?int,
     *   methodReferenceId?: ?string,
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->customerId = $values['customerId'] ?? null;
        $this->methodReferenceId = $values['methodReferenceId'] ?? null;
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
