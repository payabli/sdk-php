<?php

namespace Payabli\Traits;

use Payabli\Core\Json\JsonProperty;

/**
 * Minimal response wrapper used by approval-style endpoints that don't carry
 * the standard response envelope.
 *
 * @property ?bool $isSuccess
 * @property string $responseText
 */
trait PayabliApiResponseGeneric2Part
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;
}
