<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response data for canceling a single payout transaction. Mirrors the general response data, with `VendorId` added alongside `CustomerId`.
 */
class CancelPayoutResponseData extends JsonSerializableType
{
    /**
     * @var ?string $authCode
     */
    #[JsonProperty('AuthCode')]
    public ?string $authCode;

    /**
     * @var ?string $avsResponseText
     */
    #[JsonProperty('avsResponseText')]
    public ?string $avsResponseText;

    /**
     * @var ?int $customerId Payabli-generated unique ID of the vendor on the payout. Returns the same value as `VendorId`, or `0` when no vendor is associated.
     */
    #[JsonProperty('CustomerId')]
    public ?int $customerId;

    /**
     * @var ?int $vendorId Payabli-generated unique ID of the vendor on the payout. Returns the same value as `CustomerId`, or `0` when no vendor is associated.
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

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
     *   authCode?: ?string,
     *   avsResponseText?: ?string,
     *   customerId?: ?int,
     *   vendorId?: ?int,
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
        $this->vendorId = $values['vendorId'] ?? null;
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
