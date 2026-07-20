<?php

namespace Payabli\MoneyIn\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\TransRequestBody;

class RequestPayment extends JsonSerializableType
{
    /**
     * @var ?bool $achValidation When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
     */
    public ?bool $achValidation;

    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?bool $includeDetails When `true`, transactionDetails object is returned in the response. See a full example of the `transactionDetails` object in the [Transaction integration guide](/developers/developer-guides/money-in-transaction-add#includedetailstrue-response).
     */
    public ?bool $includeDetails;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?string $validationCode Value obtained from user when an API generated CAPTCHA is used in payment page
     */
    public ?string $validationCode;

    /**
     * @var TransRequestBody $body
     */
    public TransRequestBody $body;

    /**
     * @param array{
     *   body: TransRequestBody,
     *   achValidation?: ?bool,
     *   forceCustomerCreation?: ?bool,
     *   includeDetails?: ?bool,
     *   idempotencyKey?: ?string,
     *   validationCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->achValidation = $values['achValidation'] ?? null;
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->includeDetails = $values['includeDetails'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->validationCode = $values['validationCode'] ?? null;
        $this->body = $values['body'];
    }
}
