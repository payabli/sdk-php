<?php

namespace Payabli\PaymentLink\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\PaymentPageRequestBodyOut;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PaymentLinkStatus;

class PatchOutPaymentLinkRequest extends JsonSerializableType
{
    /**
     * @var ?PaymentPageRequestBodyOut $billPageData Updated payment link page configuration.
     */
    #[JsonProperty('billPageData')]
    public ?PaymentPageRequestBodyOut $billPageData;

    /**
     * @var ?string $expirationDate New expiration date for the payment link. Must be a future date. If null and the link is expired, uses the default expiration from settings. Updating the expiration date reactivates an expired payment link to Active status.
     */
    #[JsonProperty('expirationDate')]
    public ?string $expirationDate;

    /**
     * @var ?value-of<PaymentLinkStatus> $status Updated status for the payment link.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @param array{
     *   billPageData?: ?PaymentPageRequestBodyOut,
     *   expirationDate?: ?string,
     *   status?: ?value-of<PaymentLinkStatus>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->billPageData = $values['billPageData'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->status = $values['status'] ?? null;
    }
}
