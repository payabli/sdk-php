<?php

namespace Payabli\Vendor\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ScheduleEnrichmentCallRequest extends JsonSerializableType
{
    /**
     * @var int $vendorId ID of the vendor to call. Must be active and belong to the entrypoint in the path.
     */
    #[JsonProperty('vendorId')]
    public int $vendorId;

    /**
     * @var ?string $phone Vendor phone number to call, digits only. Optional. When omitted, Payabli uses the phone number on the vendor's record. If the vendor has no phone on record, the request returns an error.
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $enrichmentId ID of the originating enrichment run to associate with this call. Optional. When omitted, Payabli generates a standalone call schedule and skips the enrichment lookup. The bill due-date check only runs when both `enrichmentId` and `billId` are supplied.
     */
    #[JsonProperty('enrichmentId')]
    public ?string $enrichmentId;

    /**
     * @var ?int $billId Bill ID used for the due-date check. When the bill is due in fewer than three days, the call is skipped and the fallback method is applied. Only evaluated when `enrichmentId` is also supplied.
     */
    #[JsonProperty('billId')]
    public ?int $billId;

    /**
     * @var ?string $fallbackMethod Payment method to apply to the vendor record if the call can't determine a preference or all retries are exhausted. Values are `check` (the default) or `managed`.
     */
    #[JsonProperty('fallbackMethod')]
    public ?string $fallbackMethod;

    /**
     * @var ?int $maxRetries Number of times to retry the call if the vendor doesn't answer. Defaults to 3. Maximum is 5. The get outreach call status response reports this value as `maxAttempts`.
     */
    #[JsonProperty('maxRetries')]
    public ?int $maxRetries;

    /**
     * @var ?string $timezone IANA timezone identifier used to schedule the call in the vendor's local time. Defaults to `America/New_York`.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

    /**
     * @var ?bool $sendNow When `true`, dispatches the call immediately and bypasses the business-hours window and the bill due-date check. Defaults to `false`.
     */
    #[JsonProperty('sendNow')]
    public ?bool $sendNow;

    /**
     * @param array{
     *   vendorId: int,
     *   phone?: ?string,
     *   enrichmentId?: ?string,
     *   billId?: ?int,
     *   fallbackMethod?: ?string,
     *   maxRetries?: ?int,
     *   timezone?: ?string,
     *   sendNow?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->vendorId = $values['vendorId'];
        $this->phone = $values['phone'] ?? null;
        $this->enrichmentId = $values['enrichmentId'] ?? null;
        $this->billId = $values['billId'] ?? null;
        $this->fallbackMethod = $values['fallbackMethod'] ?? null;
        $this->maxRetries = $values['maxRetries'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->sendNow = $values['sendNow'] ?? null;
    }
}
