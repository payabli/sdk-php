<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Vendor contact information and payment acceptance info found through web search.
 */
class VendorEnrichmentWebSearch extends JsonSerializableType
{
    /**
     * @var ?string $phone Phone number found through web search. Format isn't guaranteed.
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $phoneType Phone classification. Values are `main`, `billing`, or `customer_service`.
     */
    #[JsonProperty('phoneType')]
    public ?string $phoneType;

    /**
     * @var ?string $email Email address.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $emailType Email classification. Values are `billing`, `general`, or `customer_service`.
     */
    #[JsonProperty('emailType')]
    public ?string $emailType;

    /**
     * @var ?string $street Street address.
     */
    #[JsonProperty('street')]
    public ?string $street;

    /**
     * @var ?string $city City.
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?string $state State (two-letter abbreviation).
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?string $zipCode ZIP code.
     */
    #[JsonProperty('zipCode')]
    public ?string $zipCode;

    /**
     * @var ?string $country Country code.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $addressType Address classification. Values are `business`, `headquarters`, or `mailing`.
     */
    #[JsonProperty('addressType')]
    public ?string $addressType;

    /**
     * @var ?string $paymentLink Payment portal URL.
     */
    #[JsonProperty('paymentLink')]
    public ?string $paymentLink;

    /**
     * @var ?string $paymentLinkType Link classification. Values are `payment_portal`, `billing_page`, or `general_website`.
     */
    #[JsonProperty('paymentLinkType')]
    public ?string $paymentLinkType;

    /**
     * @var ?string $cardAccepted Whether the vendor accepts card payments. Values are `yes`, `no`, or `unable to determine`.
     */
    #[JsonProperty('cardAccepted')]
    public ?string $cardAccepted;

    /**
     * @var ?string $achAccepted Whether the vendor accepts ACH payments. Values are `yes`, `no`, or `unable to determine`.
     */
    #[JsonProperty('achAccepted')]
    public ?string $achAccepted;

    /**
     * @var ?string $checkAccepted Whether the vendor accepts check payments. Values are `yes`, `no`, or `unable to determine`.
     */
    #[JsonProperty('checkAccepted')]
    public ?string $checkAccepted;

    /**
     * @param array{
     *   phone?: ?string,
     *   phoneType?: ?string,
     *   email?: ?string,
     *   emailType?: ?string,
     *   street?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   zipCode?: ?string,
     *   country?: ?string,
     *   addressType?: ?string,
     *   paymentLink?: ?string,
     *   paymentLinkType?: ?string,
     *   cardAccepted?: ?string,
     *   achAccepted?: ?string,
     *   checkAccepted?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->phone = $values['phone'] ?? null;
        $this->phoneType = $values['phoneType'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->emailType = $values['emailType'] ?? null;
        $this->street = $values['street'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->zipCode = $values['zipCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->addressType = $values['addressType'] ?? null;
        $this->paymentLink = $values['paymentLink'] ?? null;
        $this->paymentLinkType = $values['paymentLinkType'] ?? null;
        $this->cardAccepted = $values['cardAccepted'] ?? null;
        $this->achAccepted = $values['achAccepted'] ?? null;
        $this->checkAccepted = $values['checkAccepted'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
