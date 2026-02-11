<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Attachment for a bill.
 */
class TransferOutDetailBillAttachment extends JsonSerializableType
{
    /**
     * @var ?string $ftype File type.
     */
    #[JsonProperty('ftype')]
    public ?string $ftype;

    /**
     * @var ?string $filename File name.
     */
    #[JsonProperty('filename')]
    public ?string $filename;

    /**
     * @var ?string $fileDescriptor File descriptor.
     */
    #[JsonProperty('fileDescriptor')]
    public ?string $fileDescriptor;

    /**
     * @var ?string $furl File URL.
     */
    #[JsonProperty('furl')]
    public ?string $furl;

    /**
     * @var ?string $fContent File content.
     */
    #[JsonProperty('fContent')]
    public ?string $fContent;

    /**
     * @param array{
     *   ftype?: ?string,
     *   filename?: ?string,
     *   fileDescriptor?: ?string,
     *   furl?: ?string,
     *   fContent?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ftype = $values['ftype'] ?? null;
        $this->filename = $values['filename'] ?? null;
        $this->fileDescriptor = $values['fileDescriptor'] ?? null;
        $this->furl = $values['furl'] ?? null;
        $this->fContent = $values['fContent'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
