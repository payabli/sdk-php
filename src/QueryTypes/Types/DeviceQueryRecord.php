<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DeviceQueryRecord extends JsonSerializableType
{
    /**
     * @var ?string $deviceId Unique identifier for the cloud device.
     */
    #[JsonProperty('deviceId')]
    public ?string $deviceId;

    /**
     * @var ?int $idCloud Internal cloud device record ID.
     */
    #[JsonProperty('idCloud')]
    public ?int $idCloud;

    /**
     * @var ?string $description Description of the device.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $serialNumber Serial number of the device.
     */
    #[JsonProperty('serialNumber')]
    public ?string $serialNumber;

    /**
     * @var ?string $friendlyName Human-readable name for the device.
     */
    #[JsonProperty('friendlyName')]
    public ?string $friendlyName;

    /**
     * @var ?string $make Manufacturer of the device.
     */
    #[JsonProperty('make')]
    public ?string $make;

    /**
     * @var ?string $model Model name of the device.
     */
    #[JsonProperty('model')]
    public ?string $model;

    /**
     * @var ?int $deviceType Type of device.
     */
    #[JsonProperty('deviceType')]
    public ?int $deviceType;

    /**
     * @var ?int $deviceStatus Current status of the device.
     */
    #[JsonProperty('deviceStatus')]
    public ?int $deviceStatus;

    /**
     * @var ?int $deviceOs Operating system of the device.
     */
    #[JsonProperty('deviceOs')]
    public ?int $deviceOs;

    /**
     * @var ?string $macAddress MAC address of the device.
     */
    #[JsonProperty('macAddress')]
    public ?string $macAddress;

    /**
     * @var ?string $lastHealthCheck Timestamp of the last health check from the device.
     */
    #[JsonProperty('lastHealthCheck')]
    public ?string $lastHealthCheck;

    /**
     * @var ?string $registrationCode Registration code used to activate the device.
     */
    #[JsonProperty('registrationCode')]
    public ?string $registrationCode;

    /**
     * @var ?int $activationAttempts Number of activation attempts for the device.
     */
    #[JsonProperty('activationAttempts')]
    public ?int $activationAttempts;

    /**
     * @var ?string $activationCodeExpiry Expiration timestamp for the device activation code.
     */
    #[JsonProperty('activationCodeExpiry')]
    public ?string $activationCodeExpiry;

    /**
     * @var ?string $createdAt Timestamp when the device record was created.
     */
    #[JsonProperty('createdAt')]
    public ?string $createdAt;

    /**
     * @var ?string $updatedAt Timestamp when the device record was last updated.
     */
    #[JsonProperty('updatedAt')]
    public ?string $updatedAt;

    /**
     * @var ?int $paypointId Numeric identifier for the paypoint.
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $paypointDba DBA name for the paypoint.
     */
    #[JsonProperty('paypointDba')]
    public ?string $paypointDba;

    /**
     * @var ?string $paypointLegal Legal name for the paypoint.
     */
    #[JsonProperty('paypointLegal')]
    public ?string $paypointLegal;

    /**
     * @var ?string $paypointEntry Entry identifier for the paypoint.
     */
    #[JsonProperty('paypointEntry')]
    public ?string $paypointEntry;

    /**
     * @var ?string $externalPaypointId External identifier for the paypoint.
     */
    #[JsonProperty('externalPaypointId')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $parentOrgId Numeric identifier for the parent organization.
     */
    #[JsonProperty('parentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $parentOrgName Name of the parent organization.
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @param array{
     *   deviceId?: ?string,
     *   idCloud?: ?int,
     *   description?: ?string,
     *   serialNumber?: ?string,
     *   friendlyName?: ?string,
     *   make?: ?string,
     *   model?: ?string,
     *   deviceType?: ?int,
     *   deviceStatus?: ?int,
     *   deviceOs?: ?int,
     *   macAddress?: ?string,
     *   lastHealthCheck?: ?string,
     *   registrationCode?: ?string,
     *   activationAttempts?: ?int,
     *   activationCodeExpiry?: ?string,
     *   createdAt?: ?string,
     *   updatedAt?: ?string,
     *   paypointId?: ?int,
     *   paypointDba?: ?string,
     *   paypointLegal?: ?string,
     *   paypointEntry?: ?string,
     *   externalPaypointId?: ?string,
     *   parentOrgId?: ?int,
     *   parentOrgName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->deviceId = $values['deviceId'] ?? null;
        $this->idCloud = $values['idCloud'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->serialNumber = $values['serialNumber'] ?? null;
        $this->friendlyName = $values['friendlyName'] ?? null;
        $this->make = $values['make'] ?? null;
        $this->model = $values['model'] ?? null;
        $this->deviceType = $values['deviceType'] ?? null;
        $this->deviceStatus = $values['deviceStatus'] ?? null;
        $this->deviceOs = $values['deviceOs'] ?? null;
        $this->macAddress = $values['macAddress'] ?? null;
        $this->lastHealthCheck = $values['lastHealthCheck'] ?? null;
        $this->registrationCode = $values['registrationCode'] ?? null;
        $this->activationAttempts = $values['activationAttempts'] ?? null;
        $this->activationCodeExpiry = $values['activationCodeExpiry'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointDba = $values['paypointDba'] ?? null;
        $this->paypointLegal = $values['paypointLegal'] ?? null;
        $this->paypointEntry = $values['paypointEntry'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
