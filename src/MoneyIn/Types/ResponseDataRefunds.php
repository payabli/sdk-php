<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ResponseDataRefunds extends JsonSerializableType
{
    /**
     * @var ?string $authCode
     */
    #[JsonProperty('authCode')]
    public ?string $authCode;

    /**
     * @var ?string $avsResponseText This field isn't applicable to refund operations.
     */
    #[JsonProperty('avsResponseText')]
    public ?string $avsResponseText;

    /**
     * @var ?int $customerId
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @var ?string $cvvResponseText This field isn't applicable to refund operations.
     */
    #[JsonProperty('cvvResponseText')]
    public ?string $cvvResponseText;

    /**
     * @var ?string $methodReferenceId This field isn't applicable to refund operations.
     */
    #[JsonProperty('methodReferenceId')]
    public ?string $methodReferenceId;

    /**
     * @var string $referenceId
     */
    #[JsonProperty('referenceId')]
    public string $referenceId;

    /**
     * @var int $resultCode
     */
    #[JsonProperty('resultCode')]
    public int $resultCode;

    /**
     * @var string $resultText Text description of the transaction result
     */
    #[JsonProperty('resultText')]
    public string $resultText;

    /**
     * @param array{
     *   referenceId: string,
     *   resultCode: int,
     *   resultText: string,
     *   authCode?: ?string,
     *   avsResponseText?: ?string,
     *   customerId?: ?int,
     *   cvvResponseText?: ?string,
     *   methodReferenceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authCode = $values['authCode'] ?? null;
        $this->avsResponseText = $values['avsResponseText'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->cvvResponseText = $values['cvvResponseText'] ?? null;
        $this->methodReferenceId = $values['methodReferenceId'] ?? null;
        $this->referenceId = $values['referenceId'];
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
