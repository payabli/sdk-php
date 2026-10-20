<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The reference and updated timestamp after a person update.
 */
class PersonUpdatedResponse extends JsonSerializableType
{
    /**
     * @var string $personReference The person reference.
     */
    #[JsonProperty('personReference')]
    public string $personReference;

    /**
     * @var DateTime $lastUpdated When the person was last updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

    /**
     * @var PersonLinks $links Hypermedia links for the person resource.
     */
    #[JsonProperty('_links')]
    public PersonLinks $links;

    /**
     * @param array{
     *   personReference: string,
     *   lastUpdated: DateTime,
     *   links: PersonLinks,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->personReference = $values['personReference'];
        $this->lastUpdated = $values['lastUpdated'];
        $this->links = $values['links'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
