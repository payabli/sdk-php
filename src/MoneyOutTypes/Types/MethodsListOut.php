<?php

namespace Payabli\MoneyOutTypes\Types;

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
     * @var ?bool $vcard When `true`, virtual card (vCard) is offered as a payout method.
     */
    #[JsonProperty('vcard')]
    public ?bool $vcard;

    /**
     * @param array{
     *   ach?: ?bool,
     *   check?: ?bool,
     *   vcard?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ach = $values['ach'] ?? null;
        $this->check = $values['check'] ?? null;
        $this->vcard = $values['vcard'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
