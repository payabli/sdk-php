<?php

namespace Payabli\MoneyIn\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\RequestPaymentValidatePaymentMethod;

class RequestPaymentValidate extends JsonSerializableType
{
    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var string $entryPoint
     */
    #[JsonProperty('entryPoint')]
    public string $entryPoint;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var RequestPaymentValidatePaymentMethod $paymentMethod Object describing payment method to use for transaction.
     */
    #[JsonProperty('paymentMethod')]
    public RequestPaymentValidatePaymentMethod $paymentMethod;

    /**
     * @param array{
     *   entryPoint: string,
     *   paymentMethod: RequestPaymentValidatePaymentMethod,
     *   idempotencyKey?: ?string,
     *   accountId?: ?string,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->entryPoint = $values['entryPoint'];
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->paymentMethod = $values['paymentMethod'];
    }
}
