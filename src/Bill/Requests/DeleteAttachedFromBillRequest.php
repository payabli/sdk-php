<?php

namespace Payabli\Bill\Requests;

use Payabli\Core\Json\JsonSerializableType;

class DeleteAttachedFromBillRequest extends JsonSerializableType
{
    /**
     * @var ?bool $returnObject When `true`, the response includes the full bill object.
     */
    public ?bool $returnObject;

    /**
     * @param array{
     *   returnObject?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->returnObject = $values['returnObject'] ?? null;
    }
}
