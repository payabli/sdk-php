<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class PostCaseMessageRequest extends JsonSerializableType
{
    /**
     * @var string $content The note text (1 to 4000 characters).
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @param array{
     *   content: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'];
    }
}
