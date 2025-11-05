<?php

namespace Payabli\MoneyIn\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\MoneyIn\Types\TransRequestBody;

class RequestPayment extends JsonSerializableType
{
    /**
     * @var ?bool $achValidation
     */
    public ?bool $achValidation;

    /**
     * @var ?bool $forceCustomerCreation
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?bool $includeDetails When `true`, transactionDetails object is returned in the response. See a full example of the `transactionDetails` object in the [Transaction integration guide](/developers/developer-guides/money-in-transaction-add#includedetailstrue-response).
     */
    public ?bool $includeDetails;

    /**
     * @var ?string $idempotencyKey
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
