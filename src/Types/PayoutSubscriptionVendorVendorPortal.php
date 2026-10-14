<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The vendor's vendor portal access. Always `null` on this endpoint.
 */
class PayoutSubscriptionVendorVendorPortal extends JsonSerializableType
{
    /**
     * @var ?bool $anyoneHasAccess When `true`, at least one user has access to the vendor portal.
     */
    #[JsonProperty('anyoneHasAccess')]
    public ?bool $anyoneHasAccess;

    /**
     * @var ?array<PayoutSubscriptionVendorVendorPortalUsersItem> $users Users with access to the vendor portal.
     */
    #[JsonProperty('users'), ArrayType([PayoutSubscriptionVendorVendorPortalUsersItem::class])]
    public ?array $users;

    /**
     * @param array{
     *   anyoneHasAccess?: ?bool,
     *   users?: ?array<PayoutSubscriptionVendorVendorPortalUsersItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->anyoneHasAccess = $values['anyoneHasAccess'] ?? null;
        $this->users = $values['users'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
