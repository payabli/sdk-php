<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A cursor-paginated page of case notes, ordered oldest to newest.
 */
class MessagePage extends JsonSerializableType
{
    /**
     * @var array<RoomMessageView> $messages The notes on this page.
     */
    #[JsonProperty('messages'), ArrayType([RoomMessageView::class])]
    public array $messages;

    /**
     * @var ?string $nextCursor The cursor for the next page. Null when there are no more notes.
     */
    #[JsonProperty('nextCursor')]
    public ?string $nextCursor;

    /**
     * @param array{
     *   messages: array<RoomMessageView>,
     *   nextCursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->messages = $values['messages'];
        $this->nextCursor = $values['nextCursor'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
