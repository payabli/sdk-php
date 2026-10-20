<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

/**
 * The full detail of a business. Sensitive fields are masked unless read from the unmasked endpoint.
 */
class BusinessDetailResponse extends JsonSerializableType
{
    /**
     * @var string $businessUuid The business reference.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

    /**
     * @var ?string $externalId Your own identifier for the business.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var ?string $legalName The registered legal name of the business.
     */
    #[JsonProperty('legalName')]
    public ?string $legalName;

    /**
     * @var ?string $description A free-text description of the business.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?value-of<BusinessDetailResponseLegalStructure> $legalStructure The business's legal structure, normalized to a canonical value on read.
     */
    #[JsonProperty('legalStructure')]
    public ?string $legalStructure;

    /**
     * @var ?string $stockSymbol The stock ticker symbol, if publicly traded.
     */
    #[JsonProperty('stockSymbol')]
    public ?string $stockSymbol;

    /**
     * @var ?string $incorporationState The state where the business is incorporated.
     */
    #[JsonProperty('incorporationState')]
    public ?string $incorporationState;

    /**
     * @var ?string $taxIdCountry The country that issued the business's tax identifier.
     */
    #[JsonProperty('taxIdCountry')]
    public ?string $taxIdCountry;

    /**
     * @var ?DateTime $establishedDate The date the business was established.
     */
    #[JsonProperty('establishedDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $establishedDate;

    /**
     * @var ?int $numberOfEmployees The number of employees.
     */
    #[JsonProperty('numberOfEmployees')]
    public ?int $numberOfEmployees;

    /**
     * @var ?float $annualRevenue The business's annual revenue.
     */
    #[JsonProperty('annualRevenue')]
    public ?float $annualRevenue;

    /**
     * @var ?string $website The business's website URL.
     */
    #[JsonProperty('website')]
    public ?string $website;

    /**
     * @var ?string $merchantCatCode The merchant category code (MCC).
     */
    #[JsonProperty('merchantCatCode')]
    public ?string $merchantCatCode;

    /**
     * @var ?string $timezone The business's time zone.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

    /**
     * @var ?array<string> $phone Phone numbers for the business.
     */
    #[JsonProperty('phone'), ArrayType(['string'])]
    public ?array $phone;

    /**
     * @var ?array<string> $emails Email addresses for the business.
     */
    #[JsonProperty('emails'), ArrayType(['string'])]
    public ?array $emails;

    /**
     * @var ?array<value-of<BusinessDetailResponseOperatingSeasonsItem>> $operatingSeasons The seasons the business operates in. Values are case-insensitive on input and returned capitalized.
     */
    #[JsonProperty('operatingSeasons'), ArrayType(['string'])]
    public ?array $operatingSeasons;

    /**
     * @var ?array<BusinessAddress> $addressDetails The business's addresses.
     */
    #[JsonProperty('addressDetails'), ArrayType([BusinessAddress::class])]
    public ?array $addressDetails;

    /**
     * @var ?array<BusinessPaymentMethod> $paymentMethods The bank accounts and cards attached to the business.
     */
    #[JsonProperty('paymentMethods'), ArrayType([BusinessPaymentMethod::class])]
    public ?array $paymentMethods;

    /**
     * Arbitrary key-value data attached to the business. When present,
     * `templateAnswers` holds the applicant's answers to a boarding
     * template's business-level custom questions, meaning questions
     * whose field path doesn't start with `person.`. It's an object
     * keyed by each question's field path, such as
     * `business.custom_referralSource`, and each answer is a string. A
     * multi-select answer is one comma-separated string, such as
     * `quickbooks,stripe`.
     *
     * Payabli saves the answers when an application is submitted
     * through the hosted boarding application. Submitting an
     * application with the API
     * (`POST /v2/requests/{requestsReference}/submit`) doesn't save them.
     * Only answers to custom questions are saved, and blank answers,
     * standard-field answers, and document uploads aren't. A later
     * hosted submit replaces the answer to the same question and keeps
     * every other answer, including answers from other applications.
     * Leaving a question blank on a later submit doesn't remove the
     * stored answer.
     *
     * @var ?array<string, mixed> $customData
     */
    #[JsonProperty('customData'), ArrayType(['string' => 'mixed'])]
    public ?array $customData;

    /**
     * @var ?bool $isForeignOwned Whether the business is foreign-owned.
     */
    #[JsonProperty('isForeignOwned')]
    public ?bool $isForeignOwned;

    /**
     * @var ?bool $isTaxExempt Whether the business is tax-exempt.
     */
    #[JsonProperty('isTaxExempt')]
    public ?bool $isTaxExempt;

    /**
     * @var ?string $taxExemptClassification The business's tax-exempt classification, such as `501(c)(3)`.
     */
    #[JsonProperty('taxExemptClassification')]
    public ?string $taxExemptClassification;

    /**
     * @var ?ProcessingMetrics $processingMetrics Expected Pay In processing profile.
     */
    #[JsonProperty('processingMetrics')]
    public ?ProcessingMetrics $processingMetrics;

    /**
     * @var ?PayoutMetrics $payoutMetrics Expected Pay Out profile.
     */
    #[JsonProperty('payoutMetrics')]
    public ?PayoutMetrics $payoutMetrics;

    /**
     * @var ?string $license The business's license number.
     */
    #[JsonProperty('license')]
    public ?string $license;

    /**
     * @var ?string $licenseState The state that issued the business's license.
     */
    #[JsonProperty('licenseState')]
    public ?string $licenseState;

    /**
     * @var ?string $taxReference The business tax identifier. Masked on standard reads (only the last four digits are shown, for example `****8993`); read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('taxReference')]
    public ?string $taxReference;

    /**
     * @var string $businessStatus The business's current status.
     */
    #[JsonProperty('businessStatus')]
    public string $businessStatus;

    /**
     * @var ?string $parentReference The organization entrypoint the business belongs to.
     */
    #[JsonProperty('parentReference')]
    public ?string $parentReference;

    /**
     * @var ?array<CertificationDetail> $certificationDetails Certifications held by the business.
     */
    #[JsonProperty('certificationDetails'), ArrayType([CertificationDetail::class])]
    public ?array $certificationDetails;

    /**
     * @var DateTime $createdAt When the business was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $lastUpdated When the business was last updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

    /**
     * @var BusinessLinks $links Hypermedia links for the business resource.
     */
    #[JsonProperty('_links')]
    public BusinessLinks $links;

    /**
     * @param array{
     *   businessUuid: string,
     *   businessStatus: string,
     *   createdAt: DateTime,
     *   lastUpdated: DateTime,
     *   links: BusinessLinks,
     *   externalId?: ?string,
     *   legalName?: ?string,
     *   description?: ?string,
     *   legalStructure?: ?value-of<BusinessDetailResponseLegalStructure>,
     *   stockSymbol?: ?string,
     *   incorporationState?: ?string,
     *   taxIdCountry?: ?string,
     *   establishedDate?: ?DateTime,
     *   numberOfEmployees?: ?int,
     *   annualRevenue?: ?float,
     *   website?: ?string,
     *   merchantCatCode?: ?string,
     *   timezone?: ?string,
     *   phone?: ?array<string>,
     *   emails?: ?array<string>,
     *   operatingSeasons?: ?array<value-of<BusinessDetailResponseOperatingSeasonsItem>>,
     *   addressDetails?: ?array<BusinessAddress>,
     *   paymentMethods?: ?array<BusinessPaymentMethod>,
     *   customData?: ?array<string, mixed>,
     *   isForeignOwned?: ?bool,
     *   isTaxExempt?: ?bool,
     *   taxExemptClassification?: ?string,
     *   processingMetrics?: ?ProcessingMetrics,
     *   payoutMetrics?: ?PayoutMetrics,
     *   license?: ?string,
     *   licenseState?: ?string,
     *   taxReference?: ?string,
     *   parentReference?: ?string,
     *   certificationDetails?: ?array<CertificationDetail>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessUuid = $values['businessUuid'];
        $this->externalId = $values['externalId'] ?? null;
        $this->legalName = $values['legalName'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->legalStructure = $values['legalStructure'] ?? null;
        $this->stockSymbol = $values['stockSymbol'] ?? null;
        $this->incorporationState = $values['incorporationState'] ?? null;
        $this->taxIdCountry = $values['taxIdCountry'] ?? null;
        $this->establishedDate = $values['establishedDate'] ?? null;
        $this->numberOfEmployees = $values['numberOfEmployees'] ?? null;
        $this->annualRevenue = $values['annualRevenue'] ?? null;
        $this->website = $values['website'] ?? null;
        $this->merchantCatCode = $values['merchantCatCode'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->emails = $values['emails'] ?? null;
        $this->operatingSeasons = $values['operatingSeasons'] ?? null;
        $this->addressDetails = $values['addressDetails'] ?? null;
        $this->paymentMethods = $values['paymentMethods'] ?? null;
        $this->customData = $values['customData'] ?? null;
        $this->isForeignOwned = $values['isForeignOwned'] ?? null;
        $this->isTaxExempt = $values['isTaxExempt'] ?? null;
        $this->taxExemptClassification = $values['taxExemptClassification'] ?? null;
        $this->processingMetrics = $values['processingMetrics'] ?? null;
        $this->payoutMetrics = $values['payoutMetrics'] ?? null;
        $this->license = $values['license'] ?? null;
        $this->licenseState = $values['licenseState'] ?? null;
        $this->taxReference = $values['taxReference'] ?? null;
        $this->businessStatus = $values['businessStatus'];
        $this->parentReference = $values['parentReference'] ?? null;
        $this->certificationDetails = $values['certificationDetails'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->lastUpdated = $values['lastUpdated'];
        $this->links = $values['links'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
