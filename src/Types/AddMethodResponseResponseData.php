<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class AddMethodResponseResponseData extends JsonSerializableType
{
    /**
     * @var ?string $referenceId Stored method identifier in Payabli platform. This ID is used to manage the stored method.
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
     * Internal unique ID of customer owner of the stored method.
     *
     * Returns `0` if the method wasn't assigned to an existing customer or no customer was created.
     *
     * @var ?int $customerId
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @var ?string $authCode Only returned when the request is declined.
     */
    #[JsonProperty('authCode')]
    public ?string $authCode;

    /**
     * @var ?string $avsResponseText Only returned when the request is declined.
     */
    #[JsonProperty('avsResponseText')]
    public ?string $avsResponseText;

    /**
     * @var ?string $cvvResponseText Only returned when the request is declined.
     */
    #[JsonProperty('cvvResponseText')]
    public ?string $cvvResponseText;

    /**
     * @var ?int $vendorId Only returned when the request is declined.
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * Stored method identifier in Payabli platform. Returns the same value as
     * `referenceId`. This field isn't returned when you convert a temporary
     * token to a permanent token, so use `referenceId` to get the stored
     * method ID.
     *
     * @var ?string $methodReferenceId
     */
    #[JsonProperty('methodReferenceId')]
    public ?string $methodReferenceId;

    /**
     * @param array{
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     *   customerId?: ?int,
     *   authCode?: ?string,
     *   avsResponseText?: ?string,
     *   cvvResponseText?: ?string,
     *   vendorId?: ?int,
     *   methodReferenceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->referenceId = $values['referenceId'] ?? null;
        $this->resultCode = $values['resultCode'] ?? null;
        $this->resultText = $values['resultText'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->authCode = $values['authCode'] ?? null;
        $this->avsResponseText = $values['avsResponseText'] ?? null;
        $this->cvvResponseText = $values['cvvResponseText'] ?? null;
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
