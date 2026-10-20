<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Businesses\Types\UpdateBusinessRequestLegalStructure;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;
use Payabli\Businesses\Types\UpdateBusinessRequestOperatingSeasonsItem;
use Payabli\Types\BusinessAddress;
use Payabli\Types\BusinessPaymentMethod;
use Payabli\Types\ProcessingMetrics;
use Payabli\Types\PayoutMetrics;

class UpdateBusinessRequest extends JsonSerializableType
{
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
     * @var ?value-of<UpdateBusinessRequestLegalStructure> $legalStructure The business's legal structure. Accepts the same values as create, and normalizes to a canonical value on read.
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
     * @var ?array<value-of<UpdateBusinessRequestOperatingSeasonsItem>> $operatingSeasons The seasons the business operates in. Values are case-insensitive on input and returned capitalized.
     */
    #[JsonProperty('operatingSeasons'), ArrayType(['string'])]
    public ?array $operatingSeasons;

    /**
     * A non-empty `addressDetails` is rejected on update. Manage a business's
     * addresses through the `/v2/businesses/{businessReference}/addresses`
     * endpoints instead. An omitted field or an empty array is accepted as
     * "no address change requested."
     *
     * @var ?array<BusinessAddress> $addressDetails
     */
    #[JsonProperty('addressDetails'), ArrayType([BusinessAddress::class])]
    public ?array $addressDetails;

    /**
     * @var ?array<BusinessPaymentMethod> $paymentMethods The bank accounts and cards attached to the business.
     */
    #[JsonProperty('paymentMethods'), ArrayType([BusinessPaymentMethod::class])]
    public ?array $paymentMethods;

    /**
     * Key-value data to merge into the business's stored `customData`.
     * Payabli stores the applicant's answers to a boarding template's
     * custom questions under the `templateAnswers` key.
     *
     * When you update a business, Payabli merges `customData` into the
     * stored value, following JSON Merge Patch (RFC 7396). Keys you
     * don't send are kept at every depth, and nested objects merge key
     * by key. Strings, numbers, Boolean values, and arrays replace the
     * stored value, and arrays aren't merged. Send a key as `null` to
     * delete it, such as `{"crmId": null}`. A `customData` that isn't
     * an object, such as an array, replaces the stored value whole.
     * Leave out `customData` to keep it as is.
     *
     * The `customData` you send can be up to 65,536 bytes serialized.
     * The limit applies to the request, not to the merged result.
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
     * @param array{
     *   externalId?: ?string,
     *   legalName?: ?string,
     *   description?: ?string,
     *   legalStructure?: ?value-of<UpdateBusinessRequestLegalStructure>,
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
     *   operatingSeasons?: ?array<value-of<UpdateBusinessRequestOperatingSeasonsItem>>,
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
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
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
    }
}
