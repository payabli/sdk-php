<?php

namespace Payabli\Cloud\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DeviceEntry extends JsonSerializableType
{
    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?string $description Description or name for the device. This can be anything, but Payabli recommends entering the name of the paypoint, or some other easy to identify descriptor. If you have several devices for one paypoint, you can give them descriptions like "Cashier 1" and "Cashier 2", or "Front Desk" and "Back Office"
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * The device registration code or serial number, depending on the model.
     *
     * - Ingenico devices: This is the activation code that's displayed on the device screen during setup.
     *
     * - PAX A920 device: This code is the serial number on the back of the device.
     *
     * @var ?string $registrationCode
     */
    #[JsonProperty('registrationCode')]
    public ?string $registrationCode;

    /**
     * @param array{
     *   idempotencyKey?: ?string,
     *   description?: ?string,
     *   registrationCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->registrationCode = $values['registrationCode'] ?? null;
    }
}
