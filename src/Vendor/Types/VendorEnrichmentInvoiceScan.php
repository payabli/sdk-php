<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Vendor contact information and payment acceptance info extracted from an invoice.
 */
class VendorEnrichmentInvoiceScan extends JsonSerializableType
{
    /**
     * @var ?string $vendorName Vendor name extracted from the invoice.
     */
    #[JsonProperty('vendorName')]
    public ?string $vendorName;

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
     * @var ?string $phone Phone number. Format isn't guaranteed and is extracted as-is from the invoice.
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $email Email address.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $paymentLink Payment portal URL, if found on the invoice.
     */
    #[JsonProperty('paymentLink')]
    public ?string $paymentLink;

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
     * @var ?string $invoiceNumber Invoice number extracted from the document.
     */
    #[JsonProperty('invoiceNumber')]
    public ?string $invoiceNumber;

    /**
     * @var ?float $amountDue Invoice amount due in USD.
     */
    #[JsonProperty('amountDue')]
    public ?float $amountDue;

    /**
     * @var ?string $dueDate Payment due date. Format is `YYYY-MM-DD`.
     */
    #[JsonProperty('dueDate')]
    public ?string $dueDate;

    /**
     * @param array{
     *   vendorName?: ?string,
     *   street?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   zipCode?: ?string,
     *   country?: ?string,
     *   phone?: ?string,
     *   email?: ?string,
     *   paymentLink?: ?string,
     *   cardAccepted?: ?string,
     *   achAccepted?: ?string,
     *   checkAccepted?: ?string,
     *   invoiceNumber?: ?string,
     *   amountDue?: ?float,
     *   dueDate?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorName = $values['vendorName'] ?? null;
        $this->street = $values['street'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->zipCode = $values['zipCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->paymentLink = $values['paymentLink'] ?? null;
        $this->cardAccepted = $values['cardAccepted'] ?? null;
        $this->achAccepted = $values['achAccepted'] ?? null;
        $this->checkAccepted = $values['checkAccepted'] ?? null;
        $this->invoiceNumber = $values['invoiceNumber'] ?? null;
        $this->amountDue = $values['amountDue'] ?? null;
        $this->dueDate = $values['dueDate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
