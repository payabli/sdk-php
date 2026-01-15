<?php

namespace Payabli\V2MoneyInTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response wrapper for declined v2 Money In transaction endpoints (HTTP 402). Returned when a transaction is declined by the card network or issuer. All decline responses use this format with unified response codes starting with 'D'. The `data` field contains transaction details.
 */
class V2DeclinedTransactionResponseWrapper extends JsonSerializableType
{
    /**
     * @var string $code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * @var string $reason
     */
    #[JsonProperty('reason')]
    public string $reason;

    /**
     * @var string $explanation
     */
    #[JsonProperty('explanation')]
    public string $explanation;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var V2TransactionDetails $data
     */
    #[JsonProperty('data')]
    public V2TransactionDetails $data;

    /**
     * @var ?string $token Pagination token (equivalent to `pageIdentifier` in v1 APIs). Returns `null` when pagination is not applicable.
     */
    #[JsonProperty('token')]
    public ?string $token;

    /**
     * @param array{
     *   code: string,
     *   reason: string,
     *   explanation: string,
     *   action: string,
     *   data: V2TransactionDetails,
     *   token?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->reason = $values['reason'];
        $this->explanation = $values['explanation'];
        $this->action = $values['action'];
        $this->data = $values['data'];
        $this->token = $values['token'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
