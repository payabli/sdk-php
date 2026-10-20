<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

/**
 * Request body to create a business.
 */
class CreateBusinessRequest extends JsonSerializableType
{
    /**
     * @var ?string $externalId Your own identifier for the business.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var string $legalName The registered legal name of the business.
     */
    #[JsonProperty('legalName')]
    public string $legalName;

    /**
     * @var ?string $description A free-text description of the business.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?value-of<CreateBusinessRequestLegalStructure> $legalStructure The business's legal structure. Case-insensitive, and several inputs normalize to the same canonical value on read (for example, `llc` and `limited-liability-company` both read back as `LimitedLiabilityCompany`).
     */
    #[JsonProperty('legalStructure')]
    public ?string $legalStructure;

    /**
     * @var ?string $stockSymbol The stock ticker symbol, if the business is publicly traded.
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
     * @var ?string $merchantCatCode The merchant category code (MCC) that classifies the business.
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
     * @var ?array<value-of<CreateBusinessRequestOperatingSeasonsItem>> $operatingSeasons The seasons the business operates in. Values are case-insensitive on input and returned capitalized.
     */
    #[JsonProperty('operatingSeasons'), ArrayType(['string'])]
    public ?array $operatingSeasons;

    /**
     * @var ?array<BusinessAddressCreate> $addressDetails The business's addresses.
     */
    #[JsonProperty('addressDetails'), ArrayType([BusinessAddressCreate::class])]
    public ?array $addressDetails;

    /**
     * @var ?array<BusinessPaymentMethod> $paymentMethods The bank accounts and cards attached to the business.
     */
    #[JsonProperty('paymentMethods'), ArrayType([BusinessPaymentMethod::class])]
    public ?array $paymentMethods;

    /**
     * Arbitrary key-value data you attach to the business. Payabli
     * stores the applicant's answers to a boarding template's custom
     * questions under the `templateAnswers` key.
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
     * @var ?ProcessingMetrics $processingMetrics
     */
    #[JsonProperty('processingMetrics')]
    public ?ProcessingMetrics $processingMetrics;

    /**
     * @var ?PayoutMetrics $payoutMetrics
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
     * @var ?string $taxReference The business tax identifier, for example an EIN.
     */
    #[JsonProperty('taxReference')]
    public ?string $taxReference;

    /**
     * @var ?string $parentReference The organization entrypoint the business belongs to. Omit to use the organization your credential belongs to.
     */
    #[JsonProperty('parentReference')]
    public ?string $parentReference;

    /**
     * @param array{
     *   legalName: string,
     *   externalId?: ?string,
     *   description?: ?string,
     *   legalStructure?: ?value-of<CreateBusinessRequestLegalStructure>,
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
     *   operatingSeasons?: ?array<value-of<CreateBusinessRequestOperatingSeasonsItem>>,
     *   addressDetails?: ?array<BusinessAddressCreate>,
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
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->externalId = $values['externalId'] ?? null;
        $this->legalName = $values['legalName'];
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
        $this->parentReference = $values['parentReference'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
