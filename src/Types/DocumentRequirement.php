<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A document the application asks for. A requirement comes from the application's template or from a Payabli business rule. For example, a business with an annual revenue of $1,000,000 or more needs bank statements.
 *
 * A person requirement appears once for each owner of the business, with that owner's `personReference`.
 */
class DocumentRequirement extends JsonSerializableType
{
    /**
     * @var string $fieldPath The requirement's identifier, such as `documents.bankStatement` or `person.documents.w9`. Send it as `fieldPath` when you upload a document for this requirement.
     */
    #[JsonProperty('fieldPath')]
    public string $fieldPath;

    /**
     * @var string $label The requirement's display name.
     */
    #[JsonProperty('label')]
    public string $label;

    /**
     * @var ?string $hint Guidance on what to upload. Omitted when the requirement has none.
     */
    #[JsonProperty('hint')]
    public ?string $hint;

    /**
     * Where the requirement comes from:
     *
     * - `template`: the application's template.
     * - `businessRule`: a Payabli rule, such as bank statements for a business with an annual revenue of $1,000,000 or more.
     *
     * @var value-of<DocumentRequirementSource> $source
     */
    #[JsonProperty('source')]
    public string $source;

    /**
     * @var array<value-of<DocumentSubjectType>> $subjectTypes The subjects a document for this requirement can be about. Send one of them as `subject` when you upload.
     */
    #[JsonProperty('subjectTypes'), ArrayType(['string'])]
    public array $subjectTypes;

    /**
     * @var ?string $personReference The person this requirement is for. Returned for person requirements only.
     */
    #[JsonProperty('personReference')]
    public ?string $personReference;

    /**
     * @var bool $required When `true`, validation reports the requirement as missing until at least one document is uploaded for it. Submit doesn't enforce document requirements.
     */
    #[JsonProperty('required')]
    public bool $required;

    /**
     * @var int $maxUploads The most documents you can upload for this requirement.
     */
    #[JsonProperty('maxUploads')]
    public int $maxUploads;

    /**
     * @var array<string> $allowedFormats The file formats this requirement accepts, such as `pdf`, `jpg`, `jpeg`, or `png`.
     */
    #[JsonProperty('allowedFormats'), ArrayType(['string'])]
    public array $allowedFormats;

    /**
     * @var int $uploadedCount The number of documents uploaded for this requirement.
     */
    #[JsonProperty('uploadedCount')]
    public int $uploadedCount;

    /**
     * @param array{
     *   fieldPath: string,
     *   label: string,
     *   source: value-of<DocumentRequirementSource>,
     *   subjectTypes: array<value-of<DocumentSubjectType>>,
     *   required: bool,
     *   maxUploads: int,
     *   allowedFormats: array<string>,
     *   uploadedCount: int,
     *   hint?: ?string,
     *   personReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->fieldPath = $values['fieldPath'];
        $this->label = $values['label'];
        $this->hint = $values['hint'] ?? null;
        $this->source = $values['source'];
        $this->subjectTypes = $values['subjectTypes'];
        $this->personReference = $values['personReference'] ?? null;
        $this->required = $values['required'];
        $this->maxUploads = $values['maxUploads'];
        $this->allowedFormats = $values['allowedFormats'];
        $this->uploadedCount = $values['uploadedCount'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
