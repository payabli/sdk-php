<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Payment methods available for Pay Out payment links. Controls which payout options are offered to the vendor.
 */
class MethodsListOut extends JsonSerializableType
{
    /**
     * @var ?bool $ach When `true`, ACH bank transfer is offered as a payout method.
     */
    #[JsonProperty('ach')]
    public ?bool $ach;

    /**
     * @var ?bool $check When `true`, physical check is offered as a payout method.
     */
    #[JsonProperty('check')]
    public ?bool $check;

    /**
     * @var ?bool $rtp When `true`, Real-Time Payments (RTP) is offered as a payout method.
     */
    #[JsonProperty('rtp')]
    public ?bool $rtp;

    /**
     * @var ?bool $vcard When `true`, virtual card (vCard) is offered as a payout method.
     */
    #[JsonProperty('vcard')]
    public ?bool $vcard;

    /**
     * @var ?bool $wire When `true`, wire transfer is offered as a payout method.
     */
    #[JsonProperty('wire')]
    public ?bool $wire;

    /**
     * @param array{
     *   ach?: ?bool,
     *   check?: ?bool,
     *   rtp?: ?bool,
     *   vcard?: ?bool,
     *   wire?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ach = $values['ach'] ?? null;
        $this->check = $values['check'] ?? null;
        $this->rtp = $values['rtp'] ?? null;
        $this->vcard = $values['vcard'] ?? null;
        $this->wire = $values['wire'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
