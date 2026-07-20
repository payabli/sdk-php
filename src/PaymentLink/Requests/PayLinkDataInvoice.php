<?php

namespace Payabli\PaymentLink\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\ContactElement;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\InvoiceElement;
use Payabli\Types\Element;
use Payabli\Types\LabelElement;
use Payabli\Types\NoteElement;
use Payabli\Types\PageElement;
use Payabli\Types\MethodElement;
use Payabli\Types\PayorElement;
use Payabli\Types\HeaderElement;
use Payabli\Types\PagelinkSetting;

class PayLinkDataInvoice extends JsonSerializableType
{
    /**
     * @var ?bool $amountFixed Indicates whether customer can modify the payment amount. A value of `true` means the amount isn't modifiable, a value `false` means the payor can modify the amount to pay.
     */
    public ?bool $amountFixed;

    /**
     * @var ?string $mail2 List of recipient email addresses. When there is more than one, separate them by a semicolon (;).
     */
    public ?string $mail2;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?ContactElement $contactUs Contact us section of payment link page. If omitted, this block is enabled at display order 11.
     */
    #[JsonProperty('contactUs')]
    public ?ContactElement $contactUs;

    /**
     * @var InvoiceElement $invoices Invoices section of payment link page. Required. Omitting it returns a `400` error with code `7045`.
     */
    #[JsonProperty('invoices')]
    public InvoiceElement $invoices;

    /**
     * @var ?Element $logo Logo section of payment link page. If omitted, this block is enabled at display order 1, and the logo image is resolved from the paypoint's entry logo.
     */
    #[JsonProperty('logo')]
    public ?Element $logo;

    /**
     * @var ?LabelElement $messageBeforePaying Message section of payment link page. If omitted, this block is enabled at display order 5.
     */
    #[JsonProperty('messageBeforePaying')]
    public ?LabelElement $messageBeforePaying;

    /**
     * @var ?NoteElement $notes Notes section of payment link page. If omitted, this block is enabled at display order 10.
     */
    #[JsonProperty('notes')]
    public ?NoteElement $notes;

    /**
     * @var ?PageElement $page Page header section of payment link page. If omitted, this block is enabled at display order 2.
     */
    #[JsonProperty('page')]
    public ?PageElement $page;

    /**
     * @var ?LabelElement $paymentButton Payment button section of payment link page. If omitted, this block is enabled at display order 6, with the label "Pay Now".
     */
    #[JsonProperty('paymentButton')]
    public ?LabelElement $paymentButton;

    /**
     * @var ?MethodElement $paymentMethods Payment methods section of payment link page. If omitted, this block is enabled at display order 3, with all payment methods enabled except RDC.
     */
    #[JsonProperty('paymentMethods')]
    public ?MethodElement $paymentMethods;

    /**
     * @var ?PayorElement $payor Customer/Payor section of payment link page
     */
    #[JsonProperty('payor')]
    public ?PayorElement $payor;

    /**
     * @var ?HeaderElement $review Review section of payment link page. If omitted, this block is enabled at display order 4.
     */
    #[JsonProperty('review')]
    public ?HeaderElement $review;

    /**
     * @var ?PagelinkSetting $settings Settings section of payment link page. If omitted, defaults are applied, including page color `#10a0e3` and language `en`.
     */
    #[JsonProperty('settings')]
    public ?PagelinkSetting $settings;

    /**
     * @param array{
     *   invoices: InvoiceElement,
     *   amountFixed?: ?bool,
     *   mail2?: ?string,
     *   idempotencyKey?: ?string,
     *   contactUs?: ?ContactElement,
     *   logo?: ?Element,
     *   messageBeforePaying?: ?LabelElement,
     *   notes?: ?NoteElement,
     *   page?: ?PageElement,
     *   paymentButton?: ?LabelElement,
     *   paymentMethods?: ?MethodElement,
     *   payor?: ?PayorElement,
     *   review?: ?HeaderElement,
     *   settings?: ?PagelinkSetting,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->amountFixed = $values['amountFixed'] ?? null;
        $this->mail2 = $values['mail2'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->contactUs = $values['contactUs'] ?? null;
        $this->invoices = $values['invoices'];
        $this->logo = $values['logo'] ?? null;
        $this->messageBeforePaying = $values['messageBeforePaying'] ?? null;
        $this->notes = $values['notes'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->paymentButton = $values['paymentButton'] ?? null;
        $this->paymentMethods = $values['paymentMethods'] ?? null;
        $this->payor = $values['payor'] ?? null;
        $this->review = $values['review'] ?? null;
        $this->settings = $values['settings'] ?? null;
    }
}
