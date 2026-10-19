<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Details of the registered device used for the transaction. `null` when the
 * transaction has no `DeviceId`, or when no matching device is registered to
 * the paypoint.
 */
class QueryDeviceData extends JsonSerializableType
{
    /**
     * @var ?string $deviceType Device type, for example `SemiIntegrated`, `Standalone`, or `Softpos`.
     */
    #[JsonProperty('deviceType')]
    public ?string $deviceType;

    /**
     * @var ?string $deviceOs Device operating system, for example `Ios` or `Android`.
     */
    #[JsonProperty('deviceOs')]
    public ?string $deviceOs;

    /**
     * @var ?string $friendlyName Name assigned to the device at registration.
     */
    #[JsonProperty('friendlyName')]
    public ?string $friendlyName;

    /**
     * @var ?string $serialNumber Device serial number.
     */
    #[JsonProperty('serialNumber')]
    public ?string $serialNumber;

    /**
     * @var ?string $make Device manufacturer. Can be an empty string.
     */
    #[JsonProperty('make')]
    public ?string $make;

    /**
     * @var ?string $model Device model.
     */
    #[JsonProperty('model')]
    public ?string $model;

    /**
     * @var ?string $macAddress Device MAC address.
     */
    #[JsonProperty('macAddress')]
    public ?string $macAddress;

    /**
     * @var ?string $deviceStatus Device registration status: `Inactive`, `Active`, `Pending`, `Superseded`, `Unregistering`, or `Unregistered`.
     */
    #[JsonProperty('deviceStatus')]
    public ?string $deviceStatus;

    /**
     * @param array{
     *   deviceType?: ?string,
     *   deviceOs?: ?string,
     *   friendlyName?: ?string,
     *   serialNumber?: ?string,
     *   make?: ?string,
     *   model?: ?string,
     *   macAddress?: ?string,
     *   deviceStatus?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->deviceType = $values['deviceType'] ?? null;
        $this->deviceOs = $values['deviceOs'] ?? null;
        $this->friendlyName = $values['friendlyName'] ?? null;
        $this->serialNumber = $values['serialNumber'] ?? null;
        $this->make = $values['make'] ?? null;
        $this->model = $values['model'] ?? null;
        $this->macAddress = $values['macAddress'] ?? null;
        $this->deviceStatus = $values['deviceStatus'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
