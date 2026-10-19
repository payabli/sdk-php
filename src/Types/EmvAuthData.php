<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * EMV data exchanged during the authorization of a device transaction. `null`
 * when both values are `null`, such as for swiped cards, device transactions
 * that never reached the processor, and non-device transactions.
 */
class EmvAuthData extends JsonSerializableType
{
    /**
     * @var ?string $requestEmvData EMV tag-length-value (TLV) data the device sent with the authorization request.
     */
    #[JsonProperty('RequestEmvData')]
    public ?string $requestEmvData;

    /**
     * @var ?string $responseEmvData EMV data returned in the authorization response. Same value as `ResponseData.emv_auth_response_data`.
     */
    #[JsonProperty('ResponseEmvData')]
    public ?string $responseEmvData;

    /**
     * @param array{
     *   requestEmvData?: ?string,
     *   responseEmvData?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->requestEmvData = $values['requestEmvData'] ?? null;
        $this->responseEmvData = $values['responseEmvData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
