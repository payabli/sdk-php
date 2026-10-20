<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A document uploaded to an application.
 */
class ApplicationDocument extends JsonSerializableType
{
    /**
     * @var string $documentReference The document reference. Use it to delete the document.
     */
    #[JsonProperty('documentReference')]
    public string $documentReference;

    /**
     * @var string $kind How the document was added to the application. Documents you upload are `applicantUpload`.
     */
    #[JsonProperty('kind')]
    public string $kind;

    /**
     * @var value-of<DocumentSubjectType> $subjectType The record the document is about.
     */
    #[JsonProperty('subjectType')]
    public string $subjectType;

    /**
     * @var ?string $personReference The person the document is about, when `subjectType` is `person`. Otherwise, `null`.
     */
    #[JsonProperty('personReference')]
    public ?string $personReference;

    /**
     * @var string $fieldPath The requirement the document was uploaded for.
     */
    #[JsonProperty('fieldPath')]
    public string $fieldPath;

    /**
     * @var string $fileName The name of the uploaded file.
     */
    #[JsonProperty('fileName')]
    public string $fileName;

    /**
     * @var string $mimeType The file's media type, such as `application/pdf`.
     */
    #[JsonProperty('mimeType')]
    public string $mimeType;

    /**
     * @var int $fileSizeBytes The file's size, in bytes.
     */
    #[JsonProperty('fileSizeBytes')]
    public int $fileSizeBytes;

    /**
     * @var DateTime $uploadedAt When the document was uploaded.
     */
    #[JsonProperty('uploadedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $uploadedAt;

    /**
     * @param array{
     *   documentReference: string,
     *   kind: string,
     *   subjectType: value-of<DocumentSubjectType>,
     *   fieldPath: string,
     *   fileName: string,
     *   mimeType: string,
     *   fileSizeBytes: int,
     *   uploadedAt: DateTime,
     *   personReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->documentReference = $values['documentReference'];
        $this->kind = $values['kind'];
        $this->subjectType = $values['subjectType'];
        $this->personReference = $values['personReference'] ?? null;
        $this->fieldPath = $values['fieldPath'];
        $this->fileName = $values['fileName'];
        $this->mimeType = $values['mimeType'];
        $this->fileSizeBytes = $values['fileSizeBytes'];
        $this->uploadedAt = $values['uploadedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
