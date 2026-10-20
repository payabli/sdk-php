<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * An immutable snapshot of a template's content. Each save in the Payabli
 * Portal appends a new version; the template's `currentVersionUuid` points at
 * the active one. The configuration objects (services, documents, devices, and
 * so on) are authored in the Portal.
 */
class TemplateVersion extends JsonSerializableType
{
    /**
     * @var string $uuid The version's unique identifier.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var int $version The version number, starting at 1 and incrementing on each save.
     */
    #[JsonProperty('version')]
    public int $version;

    /**
     * @var ?array<string, mixed> $services The processing services offered on the boarding form. Configured in the Payabli Portal.
     */
    #[JsonProperty('services'), ArrayType(['string' => 'mixed'])]
    public ?array $services;

    /**
     * @var ?array<mixed> $fieldConfigurations Per-field configuration for the boarding form. Configured in the Payabli Portal.
     */
    #[JsonProperty('fieldConfigurations'), ArrayType(['mixed'])]
    public ?array $fieldConfigurations;

    /**
     * @var ?array<mixed> $conditionalRules Rules that show, hide, or require fields based on other answers. Configured in the Payabli Portal.
     */
    #[JsonProperty('conditionalRules'), ArrayType(['mixed'])]
    public ?array $conditionalRules;

    /**
     * @var ?array<mixed> $documents Document upload requirements for the boarding form. Configured in the Payabli Portal.
     */
    #[JsonProperty('documents'), ArrayType(['mixed'])]
    public ?array $documents;

    /**
     * @var ?array<mixed> $devices The devices offered during boarding. Configured in the Payabli Portal.
     */
    #[JsonProperty('devices'), ArrayType(['mixed'])]
    public ?array $devices;

    /**
     * @var ?array<mixed> $hiddenSections Sections hidden from the boarding form. Configured in the Payabli Portal.
     */
    #[JsonProperty('hiddenSections'), ArrayType(['mixed'])]
    public ?array $hiddenSections;

    /**
     * @var ?array<int> $allowedMccs The merchant category codes (MCCs) allowed for applications from this template. Configured in the Payabli Portal.
     */
    #[JsonProperty('allowedMccs'), ArrayType(['integer'])]
    public ?array $allowedMccs;

    /**
     * @var value-of<UnderwritingMode> $underwriting
     */
    #[JsonProperty('underwriting')]
    public string $underwriting;

    /**
     * @var ?string $mpaContent The merchant processing agreement content shown during boarding.
     */
    #[JsonProperty('mpaContent')]
    public ?string $mpaContent;

    /**
     * @var ?int $payinPricingId The Pay In pricing configuration applied to applications from this template.
     */
    #[JsonProperty('payinPricingId')]
    public ?int $payinPricingId;

    /**
     * @var ?int $payoutPricingId The Pay Out pricing configuration applied to applications from this template.
     */
    #[JsonProperty('payoutPricingId')]
    public ?int $payoutPricingId;

    /**
     * @var bool $allowGuidedTour Whether the boarding form shows a guided tour.
     */
    #[JsonProperty('allowGuidedTour')]
    public bool $allowGuidedTour;

    /**
     * @var bool $allowBusinessPrefill Whether business fields can be prefilled.
     */
    #[JsonProperty('allowBusinessPrefill')]
    public bool $allowBusinessPrefill;

    /**
     * @var bool $allowSaveForLater Whether applicants can save progress and resume later.
     */
    #[JsonProperty('allowSaveForLater')]
    public bool $allowSaveForLater;

    /**
     * @var bool $allowMultipleBanks Whether applicants can add more than one bank account.
     */
    #[JsonProperty('allowMultipleBanks')]
    public bool $allowMultipleBanks;

    /**
     * @var bool $allowServiceSelection Whether applicants can choose their processing services.
     */
    #[JsonProperty('allowServiceSelection')]
    public bool $allowServiceSelection;

    /**
     * @var bool $allowDeviceSelection Whether applicants can select devices.
     */
    #[JsonProperty('allowDeviceSelection')]
    public bool $allowDeviceSelection;

    /**
     * @var bool $allowAmigoChat Whether the Amigo assistant is available during boarding.
     */
    #[JsonProperty('allowAmigoChat')]
    public bool $allowAmigoChat;

    /**
     * @var bool $allowUserCreation Whether applicants can create a user account during boarding.
     */
    #[JsonProperty('allowUserCreation')]
    public bool $allowUserCreation;

    /**
     * @var bool $allowPeoplePrefill Whether people fields can be prefilled.
     */
    #[JsonProperty('allowPeoplePrefill')]
    public bool $allowPeoplePrefill;

    /**
     * @var bool $verticalProgress Whether the progress indicator is shown vertically.
     */
    #[JsonProperty('verticalProgress')]
    public bool $verticalProgress;

    /**
     * @var bool $useFloatingInputs Whether form inputs use floating labels.
     */
    #[JsonProperty('useFloatingInputs')]
    public bool $useFloatingInputs;

    /**
     * @var bool $centerContent Whether the boarding form content is centered.
     */
    #[JsonProperty('centerContent')]
    public bool $centerContent;

    /**
     * @var bool $allowRealTimeBankVerification Whether bank accounts are verified in real time.
     */
    #[JsonProperty('allowRealTimeBankVerification')]
    public bool $allowRealTimeBankVerification;

    /**
     * @var bool $allowCheckboxSigning Whether applicants can sign with a checkbox.
     */
    #[JsonProperty('allowCheckboxSigning')]
    public bool $allowCheckboxSigning;

    /**
     * @var bool $allowTypedSignature Whether applicants can sign by typing their name.
     */
    #[JsonProperty('allowTypedSignature')]
    public bool $allowTypedSignature;

    /**
     * @var bool $allowWrittenSignature Whether applicants can sign by drawing a signature.
     */
    #[JsonProperty('allowWrittenSignature')]
    public bool $allowWrittenSignature;

    /**
     * @var bool $allowMultiOwnerEsign Whether multiple owners can e-sign the application.
     */
    #[JsonProperty('allowMultiOwnerEsign')]
    public bool $allowMultiOwnerEsign;

    /**
     * @var bool $allowConfirmationAndAttestation Whether the confirmation and attestation step is shown.
     */
    #[JsonProperty('allowConfirmationAndAttestation')]
    public bool $allowConfirmationAndAttestation;

    /**
     * @var bool $allowPciAttestation Whether the PCI attestation step is shown.
     */
    #[JsonProperty('allowPCIAttestation')]
    public bool $allowPciAttestation;

    /**
     * @var string $createdAt When the version was created.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @var string $createdBy The identifier of the user who created the version.
     */
    #[JsonProperty('createdBy')]
    public string $createdBy;

    /**
     * @param array{
     *   uuid: string,
     *   version: int,
     *   underwriting: value-of<UnderwritingMode>,
     *   allowGuidedTour: bool,
     *   allowBusinessPrefill: bool,
     *   allowSaveForLater: bool,
     *   allowMultipleBanks: bool,
     *   allowServiceSelection: bool,
     *   allowDeviceSelection: bool,
     *   allowAmigoChat: bool,
     *   allowUserCreation: bool,
     *   allowPeoplePrefill: bool,
     *   verticalProgress: bool,
     *   useFloatingInputs: bool,
     *   centerContent: bool,
     *   allowRealTimeBankVerification: bool,
     *   allowCheckboxSigning: bool,
     *   allowTypedSignature: bool,
     *   allowWrittenSignature: bool,
     *   allowMultiOwnerEsign: bool,
     *   allowConfirmationAndAttestation: bool,
     *   allowPciAttestation: bool,
     *   createdAt: string,
     *   createdBy: string,
     *   services?: ?array<string, mixed>,
     *   fieldConfigurations?: ?array<mixed>,
     *   conditionalRules?: ?array<mixed>,
     *   documents?: ?array<mixed>,
     *   devices?: ?array<mixed>,
     *   hiddenSections?: ?array<mixed>,
     *   allowedMccs?: ?array<int>,
     *   mpaContent?: ?string,
     *   payinPricingId?: ?int,
     *   payoutPricingId?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->version = $values['version'];
        $this->services = $values['services'] ?? null;
        $this->fieldConfigurations = $values['fieldConfigurations'] ?? null;
        $this->conditionalRules = $values['conditionalRules'] ?? null;
        $this->documents = $values['documents'] ?? null;
        $this->devices = $values['devices'] ?? null;
        $this->hiddenSections = $values['hiddenSections'] ?? null;
        $this->allowedMccs = $values['allowedMccs'] ?? null;
        $this->underwriting = $values['underwriting'];
        $this->mpaContent = $values['mpaContent'] ?? null;
        $this->payinPricingId = $values['payinPricingId'] ?? null;
        $this->payoutPricingId = $values['payoutPricingId'] ?? null;
        $this->allowGuidedTour = $values['allowGuidedTour'];
        $this->allowBusinessPrefill = $values['allowBusinessPrefill'];
        $this->allowSaveForLater = $values['allowSaveForLater'];
        $this->allowMultipleBanks = $values['allowMultipleBanks'];
        $this->allowServiceSelection = $values['allowServiceSelection'];
        $this->allowDeviceSelection = $values['allowDeviceSelection'];
        $this->allowAmigoChat = $values['allowAmigoChat'];
        $this->allowUserCreation = $values['allowUserCreation'];
        $this->allowPeoplePrefill = $values['allowPeoplePrefill'];
        $this->verticalProgress = $values['verticalProgress'];
        $this->useFloatingInputs = $values['useFloatingInputs'];
        $this->centerContent = $values['centerContent'];
        $this->allowRealTimeBankVerification = $values['allowRealTimeBankVerification'];
        $this->allowCheckboxSigning = $values['allowCheckboxSigning'];
        $this->allowTypedSignature = $values['allowTypedSignature'];
        $this->allowWrittenSignature = $values['allowWrittenSignature'];
        $this->allowMultiOwnerEsign = $values['allowMultiOwnerEsign'];
        $this->allowConfirmationAndAttestation = $values['allowConfirmationAndAttestation'];
        $this->allowPciAttestation = $values['allowPciAttestation'];
        $this->createdAt = $values['createdAt'];
        $this->createdBy = $values['createdBy'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
