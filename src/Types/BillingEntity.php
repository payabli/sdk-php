<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * An owning or participating entity, as returned by the View profile endpoint
 * (`entityType` serialized as an integer).
 */
class BillingEntity extends JsonSerializableType
{
    /**
     * @var int $entityType
     */
    #[JsonProperty('entityType')]
    public int $entityType;

    /**
     * @var int $entityId Identifier of the entity.
     */
    #[JsonProperty('entityId')]
    public int $entityId;

    /**
     * @param array{
     *   entityType: int,
     *   entityId: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->entityType = $values['entityType'];
        $this->entityId = $values['entityId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
