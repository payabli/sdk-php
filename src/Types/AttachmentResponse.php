<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A file attached to a case.
 */
class AttachmentResponse extends JsonSerializableType
{
    /**
     * @var string $uuid The attachment's identifier.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var string $caseUuid The case the attachment belongs to.
     */
    #[JsonProperty('caseUuid')]
    public string $caseUuid;

    /**
     * @var string $fileType The file's content type.
     */
    #[JsonProperty('fileType')]
    public string $fileType;

    /**
     * @var string $filename The file's name.
     */
    #[JsonProperty('filename')]
    public string $filename;

    /**
     * @var string $fileUrl A reference to the stored file.
     */
    #[JsonProperty('fileUrl')]
    public string $fileUrl;

    /**
     * @var DateTime $uploadedAt When the file was uploaded.
     */
    #[JsonProperty('uploadedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $uploadedAt;

    /**
     * @var string $uploadedBy The id of the user who uploaded the file.
     */
    #[JsonProperty('uploadedBy')]
    public string $uploadedBy;

    /**
     * @var ?UserRef $uploadedByUser The resolved user who uploaded the file. Null when not enriched.
     */
    #[JsonProperty('uploadedByUser')]
    public ?UserRef $uploadedByUser;

    /**
     * @param array{
     *   uuid: string,
     *   caseUuid: string,
     *   fileType: string,
     *   filename: string,
     *   fileUrl: string,
     *   uploadedAt: DateTime,
     *   uploadedBy: string,
     *   uploadedByUser?: ?UserRef,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->caseUuid = $values['caseUuid'];
        $this->fileType = $values['fileType'];
        $this->filename = $values['filename'];
        $this->fileUrl = $values['fileUrl'];
        $this->uploadedAt = $values['uploadedAt'];
        $this->uploadedBy = $values['uploadedBy'];
        $this->uploadedByUser = $values['uploadedByUser'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
