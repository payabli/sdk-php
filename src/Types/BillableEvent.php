<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A chargeable action covered by a billing profile, with the fee schedule(s)
 * that apply to it.
 */
class BillableEvent extends JsonSerializableType
{
    /**
     * @var int $id Event identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $name Internal label for the event, for example `payin-card-auth-all`.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var int $vertical
     */
    #[JsonProperty('vertical')]
    public int $vertical;

    /**
     * @var int $service
     */
    #[JsonProperty('service')]
    public int $service;

    /**
     * @var int $serviceType
     */
    #[JsonProperty('serviceType')]
    public int $serviceType;

    /**
     * @var int $eventType
     */
    #[JsonProperty('eventType')]
    public int $eventType;

    /**
     * @var int $eventGroup
     */
    #[JsonProperty('eventGroup')]
    public int $eventGroup;

    /**
     * @var int $eventSource
     */
    #[JsonProperty('eventSource')]
    public int $eventSource;

    /**
     * @var int $regionType
     */
    #[JsonProperty('regionType')]
    public int $regionType;

    /**
     * @var array<FeeSchedule> $feeSchedules The fee schedule(s) that apply to this event.
     */
    #[JsonProperty('feeSchedules'), ArrayType([FeeSchedule::class])]
    public array $feeSchedules;

    /**
     * @param array{
     *   id: int,
     *   name: string,
     *   vertical: int,
     *   service: int,
     *   serviceType: int,
     *   eventType: int,
     *   eventGroup: int,
     *   eventSource: int,
     *   regionType: int,
     *   feeSchedules: array<FeeSchedule>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->vertical = $values['vertical'];
        $this->service = $values['service'];
        $this->serviceType = $values['serviceType'];
        $this->eventType = $values['eventType'];
        $this->eventGroup = $values['eventGroup'];
        $this->eventSource = $values['eventSource'];
        $this->regionType = $values['regionType'];
        $this->feeSchedules = $values['feeSchedules'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
