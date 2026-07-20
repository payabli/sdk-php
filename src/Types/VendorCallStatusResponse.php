<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Latest AI outreach call activity for a vendor. The populated block depends on the `state` discriminator.
 */
class VendorCallStatusResponse extends JsonSerializableType
{
    /**
     * @var ?int $vendorId ID of the vendor this status applies to.
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $state Current call state. Values are: `none` (no call activity for the vendor), `scheduled` (a call is queued or being retried), `successful` (a call completed and returned data), or `failed` (the call didn't complete successfully).
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?VendorCallStatusScheduled $scheduled Populated when `state` is `scheduled`.
     */
    #[JsonProperty('scheduled')]
    public ?VendorCallStatusScheduled $scheduled;

    /**
     * @var ?VendorCallStatusCompleted $completed Populated when `state` is `successful`.
     */
    #[JsonProperty('completed')]
    public ?VendorCallStatusCompleted $completed;

    /**
     * @var ?VendorCallStatusFailed $failed Populated when `state` is `failed`.
     */
    #[JsonProperty('failed')]
    public ?VendorCallStatusFailed $failed;

    /**
     * @param array{
     *   vendorId?: ?int,
     *   state?: ?string,
     *   scheduled?: ?VendorCallStatusScheduled,
     *   completed?: ?VendorCallStatusCompleted,
     *   failed?: ?VendorCallStatusFailed,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorId = $values['vendorId'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->scheduled = $values['scheduled'] ?? null;
        $this->completed = $values['completed'] ?? null;
        $this->failed = $values['failed'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
