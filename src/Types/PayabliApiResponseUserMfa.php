<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\Union;

class PayabliApiResponseUserMfa extends JsonSerializableType
{
    /**
     * @var ?int $inactiveTokenTime
     */
    #[JsonProperty('inactiveTokenTime')]
    public ?int $inactiveTokenTime;

    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var ?int $remaining
     */
    #[JsonProperty('remaining')]
    public ?int $remaining;

    /**
     * @var (
     *    string
     *   |int
     * )|null $responseData
     */
    #[JsonProperty('responseData'), Union('string', 'integer', 'null')]
    public string|int|null $responseData;

    /**
     * @var ?string $responseText
     */
    #[JsonProperty('responseText')]
    public ?string $responseText;

    /**
     * @param array{
     *   inactiveTokenTime?: ?int,
     *   isSuccess?: ?bool,
     *   remaining?: ?int,
     *   responseData?: (
     *    string
     *   |int
     * )|null,
     *   responseText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->inactiveTokenTime = $values['inactiveTokenTime'] ?? null;
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->remaining = $values['remaining'] ?? null;
        $this->responseData = $values['responseData'] ?? null;
        $this->responseText = $values['responseText'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
