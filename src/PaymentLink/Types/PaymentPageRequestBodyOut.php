<?php

namespace Payabli\PaymentLink\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\ContactElement;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\Element;
use Payabli\Types\LabelElement;
use Payabli\Types\NoteElement;
use Payabli\Types\PageElement;
use Payabli\MoneyOutTypes\Types\MethodElementOut;
use Payabli\Types\HeaderElement;
use Payabli\Types\PagelinkSetting;

/**
 * Configuration for the Pay Out payment link page. Controls branding, messaging, vendor fields, and which payout methods are offered to the vendor.
 */
class PaymentPageRequestBodyOut extends JsonSerializableType
{
    /**
     * @var ?ContactElement $contactUs ContactUs section of payment link page.
     */
    #[JsonProperty('contactUs')]
    public ?ContactElement $contactUs;

    /**
     * @var ?Element $logo Logo section of payment link page.
     */
    #[JsonProperty('logo')]
    public ?Element $logo;

    /**
     * @var ?LabelElement $messageBeforePaying Message section of payment link page.
     */
    #[JsonProperty('messageBeforePaying')]
    public ?LabelElement $messageBeforePaying;

    /**
     * @var ?NoteElement $notes Notes section of payment link page.
     */
    #[JsonProperty('notes')]
    public ?NoteElement $notes;

    /**
     * @var ?PageElement $page Page header section of payment link page.
     */
    #[JsonProperty('page')]
    public ?PageElement $page;

    /**
     * @var ?LabelElement $paymentButton Payment button section of payment link page.
     */
    #[JsonProperty('paymentButton')]
    public ?LabelElement $paymentButton;

    /**
     * @var ?MethodElementOut $paymentMethods Payment methods section of payment link page. Use this to configure which payout methods (ACH, vCard, check) are offered to the vendor.
     */
    #[JsonProperty('paymentMethods')]
    public ?MethodElementOut $paymentMethods;

    /**
     * @var ?HeaderElement $review Review section of payment link page.
     */
    #[JsonProperty('review')]
    public ?HeaderElement $review;

    /**
     * @var ?Element $bills Bills section of payment link page.
     */
    #[JsonProperty('bills')]
    public ?Element $bills;

    /**
     * @var ?PagelinkSetting $settings Settings section of payment link page.
     */
    #[JsonProperty('settings')]
    public ?PagelinkSetting $settings;

    /**
     * @param array{
     *   contactUs?: ?ContactElement,
     *   logo?: ?Element,
     *   messageBeforePaying?: ?LabelElement,
     *   notes?: ?NoteElement,
     *   page?: ?PageElement,
     *   paymentButton?: ?LabelElement,
     *   paymentMethods?: ?MethodElementOut,
     *   review?: ?HeaderElement,
     *   bills?: ?Element,
     *   settings?: ?PagelinkSetting,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->contactUs = $values['contactUs'] ?? null;
        $this->logo = $values['logo'] ?? null;
        $this->messageBeforePaying = $values['messageBeforePaying'] ?? null;
        $this->notes = $values['notes'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->paymentButton = $values['paymentButton'] ?? null;
        $this->paymentMethods = $values['paymentMethods'] ?? null;
        $this->review = $values['review'] ?? null;
        $this->bills = $values['bills'] ?? null;
        $this->settings = $values['settings'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
