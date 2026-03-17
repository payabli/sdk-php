<?php

namespace Payabli\MoneyOutTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\AchHolderType;

/**
 * Payment method for reissuing a payout transaction. The reissue endpoint uses the payment method details directly. It doesn't fall back to the vendor's managed payment method.
 * - `{ method: "vcard" }` - Reissue as a virtual card
 * - `{ method: "check" }` - Reissue as a paper check
 * - `{ method: "ach", achHolder: "...", achRouting: "...", achAccount: "...", achAccountType: "...", achHolderType: "..." }` - Reissue as ACH with bank details
 */
class ReissuePaymentMethod extends JsonSerializableType
{
    /**
     * @var string $method Payment method type. Must be `"ach"`, `"check"`, or `"vcard"`.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var ?string $achHolder Account holder name. Required when `method` is `"ach"`.
     */
    #[JsonProperty('achHolder')]
    public ?string $achHolder;

    /**
     * @var ?string $achRouting Bank routing number (9 digits). Required when `method` is `"ach"`.
     */
    #[JsonProperty('achRouting')]
    public ?string $achRouting;

    /**
     * @var ?string $achAccount Bank account number (8-17 digits). Required when `method` is `"ach"`.
     */
    #[JsonProperty('achAccount')]
    public ?string $achAccount;

    /**
     * @var ?string $achAccountType Bank account type (`"checking"` or `"savings"`). Required when `method` is `"ach"`.
     */
    #[JsonProperty('achAccountType')]
    public ?string $achAccountType;

    /**
     * @var ?value-of<AchHolderType> $achHolderType
     */
    #[JsonProperty('achHolderType')]
    public ?string $achHolderType;

    /**
     * @param array{
     *   method: string,
     *   achHolder?: ?string,
     *   achRouting?: ?string,
     *   achAccount?: ?string,
     *   achAccountType?: ?string,
     *   achHolderType?: ?value-of<AchHolderType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->achHolder = $values['achHolder'] ?? null;
        $this->achRouting = $values['achRouting'] ?? null;
        $this->achAccount = $values['achAccount'] ?? null;
        $this->achAccountType = $values['achAccountType'] ?? null;
        $this->achHolderType = $values['achHolderType'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
