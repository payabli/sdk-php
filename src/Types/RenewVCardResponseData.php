<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class RenewVCardResponseData extends JsonSerializableType
{
    /**
     * @var ?string $authCode Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('authCode')]
    public ?string $authCode;

    /**
     * @var string $referenceId Reference identifier for the renewed virtual card returned by the card processor.
     */
    #[JsonProperty('referenceId')]
    public string $referenceId;

    /**
     * @var int $resultCode
     */
    #[JsonProperty('resultCode')]
    public int $resultCode;

    /**
     * @var string $resultText
     */
    #[JsonProperty('resultText')]
    public string $resultText;

    /**
     * @var ?string $avsResponseText Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('avsResponseText')]
    public ?string $avsResponseText;

    /**
     * @var ?string $cvvResponseText Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('cvvResponseText')]
    public ?string $cvvResponseText;

    /**
     * @var ?int $customerId Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @var ?int $vendorId Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $methodReferenceId Not used for virtual card renewal; always returns `null`.
     */
    #[JsonProperty('methodReferenceId')]
    public ?string $methodReferenceId;

    /**
     * @param array{
     *   referenceId: string,
     *   resultCode: int,
     *   resultText: string,
     *   authCode?: ?string,
     *   avsResponseText?: ?string,
     *   cvvResponseText?: ?string,
     *   customerId?: ?int,
     *   vendorId?: ?int,
     *   methodReferenceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authCode = $values['authCode'] ?? null;
        $this->referenceId = $values['referenceId'];
        $this->resultCode = $values['resultCode'];
        $this->resultText = $values['resultText'];
        $this->avsResponseText = $values['avsResponseText'] ?? null;
        $this->cvvResponseText = $values['cvvResponseText'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
        $this->methodReferenceId = $values['methodReferenceId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
