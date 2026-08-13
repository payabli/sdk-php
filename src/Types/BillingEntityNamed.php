<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * An owning entity, as returned by the List profiles endpoint (`entityType`
 * serialized as a name).
 */
class BillingEntityNamed extends JsonSerializableType
{
    /**
     * @var value-of<EntityTypeName> $entityType
     */
    #[JsonProperty('entityType')]
    public string $entityType;

    /**
     * @var int $entityId Identifier of the entity.
     */
    #[JsonProperty('entityId')]
    public int $entityId;

    /**
     * @param array{
     *   entityType: value-of<EntityTypeName>,
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
