<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\MoneyOutTypes\Types\ReissuePayoutBody;

class ReissueOutRequest extends JsonSerializableType
{
    /**
     * @var string $transId The transaction ID of the payout to reissue.
     */
    public string $transId;

    /**
     * @var ?string $idempotencyKey
     */
    public ?string $idempotencyKey;

    /**
     * @var ReissuePayoutBody $body
     */
    public ReissuePayoutBody $body;

    /**
     * @param array{
     *   transId: string,
     *   body: ReissuePayoutBody,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transId = $values['transId'];
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
