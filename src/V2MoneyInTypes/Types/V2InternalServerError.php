<?php

namespace Payabli\V2MoneyInTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Internal server error response (HTTP 500) returned when an unexpected error occurs. Follows RFC 7807 Problem Details format.
 */
class V2InternalServerError extends JsonSerializableType
{
    /**
     * @var string $title Always "Internal Server Error" for 500 errors.
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var int $status HTTP status code, always 500 for internal errors.
     */
    #[JsonProperty('status')]
    public int $status;

    /**
     * @var string $detail Additional details about the internal error.
     */
    #[JsonProperty('detail')]
    public string $detail;

    /**
     * @var string $instance Request URL that caused the error.
     */
    #[JsonProperty('instance')]
    public string $instance;

    /**
     * @param array{
     *   title: string,
     *   status: int,
     *   detail: string,
     *   instance: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'];
        $this->status = $values['status'];
        $this->detail = $values['detail'];
        $this->instance = $values['instance'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
