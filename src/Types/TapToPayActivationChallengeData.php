<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The issued activation code, its expiration, and whether it was reused.
 */
class TapToPayActivationChallengeData extends JsonSerializableType
{
    /**
     * The 6-digit activation code the partner delivers to the device
     * user to activate the device. It can start with leading zeros, so
     * keep it as a string.
     *
     * @var string $code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * UTC time when the code expires, in ISO 8601 round-trip format. A
     * code is valid for 30 minutes after it's issued.
     *
     * @var DateTime $expiresAt
     */
    #[JsonProperty('expiresAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $expiresAt;

    /**
     * `true` when an unexpired code already exists for the device and
     * this call returns it unchanged instead of generating a new one.
     *
     * @var bool $alreadyIssued
     */
    #[JsonProperty('alreadyIssued')]
    public bool $alreadyIssued;

    /**
     * @param array{
     *   code: string,
     *   expiresAt: DateTime,
     *   alreadyIssued: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->expiresAt = $values['expiresAt'];
        $this->alreadyIssued = $values['alreadyIssued'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
