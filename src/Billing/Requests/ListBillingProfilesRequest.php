<?php

namespace Payabli\Billing\Requests;

use Payabli\Core\Json\JsonSerializableType;

class ListBillingProfilesRequest extends JsonSerializableType
{
    /**
     * @var ?string $profileName Filter to profiles whose name contains this string.
     */
    public ?string $profileName;

    /**
     * Filter by fee type. Repeatable to match more than one. Send the enum
     * value (`1` Flat, `2` ICP).
     *
     * @var ?array<int> $feeType
     */
    public ?array $feeType;

    /**
     * Filter by billing vertical. Repeatable to match more than one. Send
     * the enum value (`1` PayIn, `2` PayOut, `3` PayOps).
     *
     * @var ?array<int> $serviceVertical
     */
    public ?array $serviceVertical;

    /**
     * @var ?int $profileId Filter to a single profile by its identifier.
     */
    public ?int $profileId;

    /**
     * Page size. Defaults to `20`. Passing `0` returns no records — use a
     * positive value to page through results.
     *
     * @var ?int $limitRecord
     */
    public ?int $limitRecord;

    /**
     * @var ?int $fromRecord Zero-based offset into the result set. Defaults to `0`.
     */
    public ?int $fromRecord;

    /**
     * @param array{
     *   profileName?: ?string,
     *   feeType?: ?array<int>,
     *   serviceVertical?: ?array<int>,
     *   profileId?: ?int,
     *   limitRecord?: ?int,
     *   fromRecord?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->profileName = $values['profileName'] ?? null;
        $this->feeType = $values['feeType'] ?? null;
        $this->serviceVertical = $values['serviceVertical'] ?? null;
        $this->profileId = $values['profileId'] ?? null;
        $this->limitRecord = $values['limitRecord'] ?? null;
        $this->fromRecord = $values['fromRecord'] ?? null;
    }
}
