<?php

namespace Payabli\TokenStorage\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\RequestTokenStorage;

class UpdateMethodRequest extends JsonSerializableType
{
    /**
     * @var ?bool $achValidation When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
     */
    public ?bool $achValidation;

    /**
     * @var RequestTokenStorage $body
     */
    public RequestTokenStorage $body;

    /**
     * @param array{
     *   body: RequestTokenStorage,
     *   achValidation?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->achValidation = $values['achValidation'] ?? null;
        $this->body = $values['body'];
    }
}
