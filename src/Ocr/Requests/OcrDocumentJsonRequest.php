<?php

namespace Payabli\Ocr\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\FileContentFtype;
use Payabli\Core\Json\JsonProperty;

class OcrDocumentJsonRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<FileContentFtype> $ftype
     */
    #[JsonProperty('ftype')]
    public ?string $ftype;

    /**
     * @var ?string $filename The name of the file to be uploaded
     */
    #[JsonProperty('filename')]
    public ?string $filename;

    /**
     * @var ?string $furl Optional URL link to the file
     */
    #[JsonProperty('furl')]
    public ?string $furl;

    /**
     * @var ?string $fContent Base64-encoded file content
     */
    #[JsonProperty('fContent')]
    public ?string $fContent;

    /**
     * @param array{
     *   ftype?: ?value-of<FileContentFtype>,
     *   filename?: ?string,
     *   furl?: ?string,
     *   fContent?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ftype = $values['ftype'] ?? null;
        $this->filename = $values['filename'] ?? null;
        $this->furl = $values['furl'] ?? null;
        $this->fContent = $values['fContent'] ?? null;
    }
}
