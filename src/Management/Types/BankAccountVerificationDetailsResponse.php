<?php

namespace Payabli\Management\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Detailed bank account verification results from the verification network.
 */
class BankAccountVerificationDetailsResponse extends JsonSerializableType
{
    /**
     * @var ?string $aba The ABA routing number that was verified.
     */
    #[JsonProperty('aba')]
    public ?string $aba;

    /**
     * @var ?string $accountNumber The account number that was verified.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var bool $isValid Whether the bank account passed verification.
     */
    #[JsonProperty('isValid')]
    public bool $isValid;

    /**
     * @var ?string $errorMessage Error message if the verification request failed.
     */
    #[JsonProperty('errorMessage')]
    public ?string $errorMessage;

    /**
     * @var ?string $verificationResponse Overall verification outcome. Possible values include `Pass`, `Verified`, `Declined`, `NoData`, `Bypassed`, and `Error`.
     */
    #[JsonProperty('verificationResponse')]
    public ?string $verificationResponse;

    /**
     * @var ?string $responseCode Response code returned by the verification network.
     */
    #[JsonProperty('responseCode')]
    public ?string $responseCode;

    /**
     * @var ?string $responseValue Response value associated with the verification outcome.
     */
    #[JsonProperty('responseValue')]
    public ?string $responseValue;

    /**
     * @var ?string $responseDescription Human-readable description of the verification outcome.
     */
    #[JsonProperty('responseDescription')]
    public ?string $responseDescription;

    /**
     * @var ?string $bankName Name of the bank associated with the routing number.
     */
    #[JsonProperty('bankName')]
    public ?string $bankName;

    /**
     * @var ?string $reportedAccountType Account type as reported by the verification network, such as `Checking` or `Savings`.
     */
    #[JsonProperty('reportedAccountType')]
    public ?string $reportedAccountType;

    /**
     * @var ?string $accountAddedDate Date the account was first seen by the verification network (ISO 8601 format).
     */
    #[JsonProperty('accountAddedDate')]
    public ?string $accountAddedDate;

    /**
     * @var ?string $accountLastUpdatedDate Date the account record was last updated in the verification network (ISO 8601 format).
     */
    #[JsonProperty('accountLastUpdatedDate')]
    public ?string $accountLastUpdatedDate;

    /**
     * @var ?string $accountClosedDate Date the account was closed, if applicable (ISO 8601 format).
     */
    #[JsonProperty('accountClosedDate')]
    public ?string $accountClosedDate;

    /**
     * @param array{
     *   isValid: bool,
     *   aba?: ?string,
     *   accountNumber?: ?string,
     *   errorMessage?: ?string,
     *   verificationResponse?: ?string,
     *   responseCode?: ?string,
     *   responseValue?: ?string,
     *   responseDescription?: ?string,
     *   bankName?: ?string,
     *   reportedAccountType?: ?string,
     *   accountAddedDate?: ?string,
     *   accountLastUpdatedDate?: ?string,
     *   accountClosedDate?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->aba = $values['aba'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->isValid = $values['isValid'];
        $this->errorMessage = $values['errorMessage'] ?? null;
        $this->verificationResponse = $values['verificationResponse'] ?? null;
        $this->responseCode = $values['responseCode'] ?? null;
        $this->responseValue = $values['responseValue'] ?? null;
        $this->responseDescription = $values['responseDescription'] ?? null;
        $this->bankName = $values['bankName'] ?? null;
        $this->reportedAccountType = $values['reportedAccountType'] ?? null;
        $this->accountAddedDate = $values['accountAddedDate'] ?? null;
        $this->accountLastUpdatedDate = $values['accountLastUpdatedDate'] ?? null;
        $this->accountClosedDate = $values['accountClosedDate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
