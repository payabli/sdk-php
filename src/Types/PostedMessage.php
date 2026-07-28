<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The result of posting a note to a case.
 */
class PostedMessage extends JsonSerializableType
{
    /**
     * @var int $messageId The new message's identifier.
     */
    #[JsonProperty('messageId')]
    public int $messageId;

    /**
     * @var int $roomId The message room the note was posted to.
     */
    #[JsonProperty('roomId')]
    public int $roomId;

    /**
     * @var DateTime $createdAt When the note was posted.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @param array{
     *   messageId: int,
     *   roomId: int,
     *   createdAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->messageId = $values['messageId'];
        $this->roomId = $values['roomId'];
        $this->createdAt = $values['createdAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
