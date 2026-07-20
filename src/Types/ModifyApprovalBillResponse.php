<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\PayabliApiResponseGeneric2Part;
use Payabli\Core\Json\JsonProperty;

/**
 * Response from approval-modification endpoints.
 */
class ModifyApprovalBillResponse extends JsonSerializableType
{
    use PayabliApiResponseGeneric2Part;

    /**
     * If `isSuccess` = true, this contains the bill identifier. If
     * `isSuccess` = false, this contains the reason for the error.
     *
     * @var ?int $responseData
     */
    #[JsonProperty('responseData')]
    public ?int $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseText = $values['responseText'];
        $this->responseData = $values['responseData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
