<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A message associated with an outbound transfer.
 */
class TransferOutMessage extends JsonSerializableType
{
    /**
     * @var ?int $id Unique identifier for the message.
     */
    #[JsonProperty('Id')]
    public ?int $id;

    /**
     * @var ?int $roomId The ID of the room where the message was sent.
     */
    #[JsonProperty('RoomId')]
    public ?int $roomId;

    /**
     * @var ?int $userId The ID of the user who sent the message.
     */
    #[JsonProperty('UserId')]
    public ?int $userId;

    /**
     * @var ?string $userName The name of the user who sent the message.
     */
    #[JsonProperty('UserName')]
    public ?string $userName;

    /**
     * @var ?string $content The content of the message.
     */
    #[JsonProperty('Content')]
    public ?string $content;

    /**
     * @var ?string $createdAt The time the message was created.
     */
    #[JsonProperty('CreatedAt')]
    public ?string $createdAt;

    /**
     * @var ?int $messageType The type of message.
     */
    #[JsonProperty('MessageType')]
    public ?int $messageType;

    /**
     * @var ?TransferOutMessageProperties $messageProperties Additional properties for the message.
     */
    #[JsonProperty('MessageProperties')]
    public ?TransferOutMessageProperties $messageProperties;

    /**
     * @param array{
     *   id?: ?int,
     *   roomId?: ?int,
     *   userId?: ?int,
     *   userName?: ?string,
     *   content?: ?string,
     *   createdAt?: ?string,
     *   messageType?: ?int,
     *   messageProperties?: ?TransferOutMessageProperties,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->roomId = $values['roomId'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->userName = $values['userName'] ?? null;
        $this->content = $values['content'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->messageType = $values['messageType'] ?? null;
        $this->messageProperties = $values['messageProperties'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
