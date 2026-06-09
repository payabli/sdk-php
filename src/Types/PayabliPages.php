<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class PayabliPages extends JsonSerializableType
{
    /**
     * @var ?array<string, array<string, mixed>> $additionalData
     */
    #[JsonProperty('AdditionalData'), ArrayType(['string' => ['string' => 'mixed']])]
    public ?array $additionalData;

    /**
     * @var ?array<PayabliCredentials> $credentials Array of credential objects with active services for the page
     */
    #[JsonProperty('Credentials'), ArrayType([PayabliCredentials::class])]
    public ?array $credentials;

    /**
     * @var ?DateTime $lastAccess Timestamp of last access to page structure
     */
    #[JsonProperty('LastAccess'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastAccess;

    /**
     * @var ?PageContent $pageContent Sections of page
     */
    #[JsonProperty('PageContent')]
    public ?PageContent $pageContent;

    /**
     * @var ?string $pageIdentifier
     */
    #[JsonProperty('pageIdentifier')]
    public ?string $pageIdentifier;

    /**
     * @var ?PageSetting $pageSettings Settings of page
     */
    #[JsonProperty('PageSettings')]
    public ?PageSetting $pageSettings;

    /**
     * @var ?int $published Flag indicating if page is active to accept payments. `0` for false, `1` for true.
     */
    #[JsonProperty('published')]
    public ?int $published;

    /**
     * @var ?ReceiptContent $receiptContent Sections of payment receipt
     */
    #[JsonProperty('ReceiptContent')]
    public ?ReceiptContent $receiptContent;

    /**
     * @var ?string $subdomain Page identifier. Must be unique in platform.
     */
    #[JsonProperty('Subdomain')]
    public ?string $subdomain;

    /**
     * @var ?float $totalAmount Total amount to pay in this page
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?string $validationCode Base64 encoded image of CAPTCHA associated to this page load
     */
    #[JsonProperty('validationCode')]
    public ?string $validationCode;

    /**
     * @param array{
     *   additionalData?: ?array<string, array<string, mixed>>,
     *   credentials?: ?array<PayabliCredentials>,
     *   lastAccess?: ?DateTime,
     *   pageContent?: ?PageContent,
     *   pageIdentifier?: ?string,
     *   pageSettings?: ?PageSetting,
     *   published?: ?int,
     *   receiptContent?: ?ReceiptContent,
     *   subdomain?: ?string,
     *   totalAmount?: ?float,
     *   validationCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->additionalData = $values['additionalData'] ?? null;
        $this->credentials = $values['credentials'] ?? null;
        $this->lastAccess = $values['lastAccess'] ?? null;
        $this->pageContent = $values['pageContent'] ?? null;
        $this->pageIdentifier = $values['pageIdentifier'] ?? null;
        $this->pageSettings = $values['pageSettings'] ?? null;
        $this->published = $values['published'] ?? null;
        $this->receiptContent = $values['receiptContent'] ?? null;
        $this->subdomain = $values['subdomain'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->validationCode = $values['validationCode'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
