<?php

namespace Payabli\MoneyIn\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PayorDataRequest;
use Payabli\Types\PaymentDetailCredit;
use Payabli\Types\RequestCreditPaymentMethod;

class RequestCredit extends JsonSerializableType
{
    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
     */
    public ?bool $forceCustomerCreation;

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
     * @var PayorDataRequest $customerData Object describing the customer/payor.
     */
    #[JsonProperty('customerData')]
    public PayorDataRequest $customerData;

    /**
     * @var ?string $entrypoint
     */
    #[JsonProperty('entrypoint')]
    public ?string $entrypoint;

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
     * @var PaymentDetailCredit $paymentDetails
     */
    #[JsonProperty('paymentDetails')]
    public PaymentDetailCredit $paymentDetails;

    /**
     * @var RequestCreditPaymentMethod $paymentMethod Object describing the ACH payment method to use for transaction.
     */
    #[JsonProperty('paymentMethod')]
    public RequestCreditPaymentMethod $paymentMethod;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?string $subdomain
     */
    #[JsonProperty('subdomain')]
    public ?string $subdomain;

    /**
     * @param array{
     *   customerData: PayorDataRequest,
     *   paymentDetails: PaymentDetailCredit,
     *   paymentMethod: RequestCreditPaymentMethod,
     *   forceCustomerCreation?: ?bool,
     *   idempotencyKey?: ?string,
     *   accountId?: ?string,
     *   entrypoint?: ?string,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   source?: ?string,
     *   subdomain?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->customerData = $values['customerData'];
        $this->entrypoint = $values['entrypoint'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->paymentDetails = $values['paymentDetails'];
        $this->paymentMethod = $values['paymentMethod'];
        $this->source = $values['source'] ?? null;
        $this->subdomain = $values['subdomain'] ?? null;
    }
}
