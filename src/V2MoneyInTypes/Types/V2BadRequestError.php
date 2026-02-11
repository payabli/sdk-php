<?php

namespace Payabli\V2MoneyInTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Bad request error response (HTTP 400) returned when request validation fails. Follows RFC 7807 Problem Details format with additional Payabli-specific fields.
 */
class V2BadRequestError extends JsonSerializableType
{
    /**
     * @var string $type A URI reference that identifies the problem type. Points to human-readable documentation for this error type.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $title Always "Bad Request" for 400 errors.
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var int $status HTTP status code, always 400 for bad requests.
     */
    #[JsonProperty('status')]
    public int $status;

    /**
     * @var string $detail Short description of the error.
     */
    #[JsonProperty('detail')]
    public string $detail;

    /**
     * @var string $instance Request URL that caused the error.
     */
    #[JsonProperty('instance')]
    public string $instance;

    /**
     * @var string $code Payabli's unified response code for validation errors. Starts with 'E'. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * @var array<string, array<V2BadRequestErrorDetail>> $errors Dictionary of field-specific validation errors. Keys are field paths (e.g., "paymentMethod.cardnumber") and values are arrays of error details.
     */
    #[JsonProperty('errors'), ArrayType(['string' => [V2BadRequestErrorDetail::class]])]
    public array $errors;

    /**
     * @var ?string $token Pagination token (equivalent to pageIdentifier in v1 APIs). Usually null for errors.
     */
    #[JsonProperty('token')]
    public ?string $token;

    /**
     * @param array{
     *   type: string,
     *   title: string,
     *   status: int,
     *   detail: string,
     *   instance: string,
     *   code: string,
     *   errors: array<string, array<V2BadRequestErrorDetail>>,
     *   token?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->title = $values['title'];
        $this->status = $values['status'];
        $this->detail = $values['detail'];
        $this->instance = $values['instance'];
        $this->code = $values['code'];
        $this->errors = $values['errors'];
        $this->token = $values['token'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
