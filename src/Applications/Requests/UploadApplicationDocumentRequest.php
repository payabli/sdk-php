<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Utils\File;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\DocumentSubjectType;

class UploadApplicationDocumentRequest extends JsonSerializableType
{
    /**
     * @var File $file
     */
    public File $file;

    /**
     * @var string $fieldPath The `fieldPath` of the requirement you're uploading for, from [List application document requirements](/developers/api-reference/applications/list-application-document-requirements).
     */
    #[JsonProperty('fieldPath')]
    public string $fieldPath;

    /**
     * @var value-of<DocumentSubjectType> $subject The record the document is about. Send one of the requirement's `subjectTypes`.
     */
    #[JsonProperty('subject')]
    public string $subject;

    /**
     * @var ?string $personReference The person the document is about. Required when `subject` is `person`. Use the `personReference` from the person's requirement.
     */
    #[JsonProperty('personReference')]
    public ?string $personReference;

    /**
     * @param array{
     *   file: File,
     *   fieldPath: string,
     *   subject: value-of<DocumentSubjectType>,
     *   personReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->file = $values['file'];
        $this->fieldPath = $values['fieldPath'];
        $this->subject = $values['subject'];
        $this->personReference = $values['personReference'] ?? null;
    }
}
