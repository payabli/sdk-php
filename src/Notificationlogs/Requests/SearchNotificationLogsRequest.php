<?php

namespace Payabli\Notificationlogs\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Notificationlogs\Types\NotificationLogSearchRequest;

class SearchNotificationLogsRequest extends JsonSerializableType
{
    /**
     * @var ?int $pageSize
     */
    public ?int $pageSize;

    /**
     * @var ?int $page The page number to retrieve. Defaults to 1 if not provided.
     */
    public ?int $page;

    /**
     * @var NotificationLogSearchRequest $body
     */
    public NotificationLogSearchRequest $body;

    /**
     * @param array{
     *   body: NotificationLogSearchRequest,
     *   pageSize?: ?int,
     *   page?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->pageSize = $values['pageSize'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->body = $values['body'];
    }
}
