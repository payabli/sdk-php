<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class PayabliApiResponseResponseDataMoneyInLowercase extends JsonSerializableType
{
    /**
     * @var ?string $authCode
     */
    #[JsonProperty('authCode')]
    public ?string $authCode;

    /**
     * @var ?string $avsResponseText
     */
    #[JsonProperty('avsResponseText')]
    public ?string $avsResponseText;

    /**
     * @var ?int $customerId
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @var ?string $cvvResponseText
     */
    #[JsonProperty('cvvResponseText')]
    public ?string $cvvResponseText;

    /**
     * @var ?string $methodReferenceId
     */
    #[JsonProperty('methodReferenceId')]
    public ?string $methodReferenceId;

    /**
     * @var ?string $referenceId
     */
    #[JsonProperty('referenceId')]
    public ?string $referenceId;

    /**
     * @var ?int $resultCode
     */
    #[JsonProperty('resultCode')]
    public ?int $resultCode;

    /**
     * @var ?string $resultText
     */
    #[JsonProperty('resultText')]
    public ?string $resultText;

    /**
     * @param array{
     *   authCode?: ?string,
     *   avsResponseText?: ?string,
     *   customerId?: ?int,
     *   cvvResponseText?: ?string,
     *   methodReferenceId?: ?string,
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->authCode = $values['authCode'] ?? null;
        $this->avsResponseText = $values['avsResponseText'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->cvvResponseText = $values['cvvResponseText'] ?? null;
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
