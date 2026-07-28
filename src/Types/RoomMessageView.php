<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A note on a case.
 */
class RoomMessageView extends JsonSerializableType
{
    /**
     * @var int $id The message's identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var int $userId The numeric id of the user who posted the note.
     */
    #[JsonProperty('userId')]
    public int $userId;

    /**
     * @var string $content The note text.
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @var DateTime $createdAt When the note was posted.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt When the note was last edited. Null when never edited.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $updatedAt;

    /**
     * @param array{
     *   id: int,
     *   userId: int,
     *   content: string,
     *   createdAt: DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->userId = $values['userId'];
        $this->content = $values['content'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
