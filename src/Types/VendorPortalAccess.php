<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The vendor's vendor portal access.
 */
class VendorPortalAccess extends JsonSerializableType
{
    /**
     * @var ?bool $anyoneHasAccess When `true`, at least one user has access to the vendor portal.
     */
    #[JsonProperty('AnyoneHasAccess')]
    public ?bool $anyoneHasAccess;

    /**
     * @var ?array<VendorPortalAccessUsersItem> $users Users with access to the vendor portal.
     */
    #[JsonProperty('Users'), ArrayType([VendorPortalAccessUsersItem::class])]
    public ?array $users;

    /**
     * @param array{
     *   anyoneHasAccess?: ?bool,
     *   users?: ?array<VendorPortalAccessUsersItem>,
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
