<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Signature captured on a card-present device. Always `null` for payout subscriptions.
 */
class PayoutSubscriptionPaymentDataPascalPayorSignature extends JsonSerializableType
{
    /**
     * @var ?string $status Availability of the signature. One of `stored`, `pending`, or `unavailable`.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?string $format Image format of the stored signature, `png` or `jpeg`.
     */
    #[JsonProperty('format')]
    public ?string $format;

    /**
     * @var ?string $content Base64-encoded signature image. Only set when `status` is `stored`.
     */
    #[JsonProperty('content')]
    public ?string $content;

    /**
     * @param array{
     *   status?: ?string,
     *   format?: ?string,
     *   content?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->format = $values['format'] ?? null;
        $this->content = $values['content'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
