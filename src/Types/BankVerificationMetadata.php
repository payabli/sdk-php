<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The outcome of automatic bank account verification.
 */
class BankVerificationMetadata extends JsonSerializableType
{
    /**
     * @var VerificationCode $verificationResult
     */
    #[JsonProperty('verificationResult')]
    public VerificationCode $verificationResult;

    /**
     * @var ?VerificationCode $accountResponseCode The account-level verification code. Null when not returned.
     */
    #[JsonProperty('accountResponseCode')]
    public ?VerificationCode $accountResponseCode;

    /**
     * @var ?VerificationCode $customerResponseCode The customer-level verification code. Null when not returned.
     */
    #[JsonProperty('customerResponseCode')]
    public ?VerificationCode $customerResponseCode;

    /**
     * @param array{
     *   verificationResult: VerificationCode,
     *   accountResponseCode?: ?VerificationCode,
     *   customerResponseCode?: ?VerificationCode,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->verificationResult = $values['verificationResult'];
        $this->accountResponseCode = $values['accountResponseCode'] ?? null;
        $this->customerResponseCode = $values['customerResponseCode'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
