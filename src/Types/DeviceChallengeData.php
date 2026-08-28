<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The issued activation code and the time it expires.
 */
class DeviceChallengeData extends JsonSerializableType
{
    /**
     * The 6-digit verification code the operator enters on the device's
     * terminal to activate it. It can start with leading zeros, so keep it as
     * a string.
     *
     * @var string $code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * UTC time when the code expires, in ISO-8601 round-trip format. A code is
     * valid for 5 minutes after it's issued.
     *
     * @var DateTime $expiresAt
     */
    #[JsonProperty('expiresAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $expiresAt;

    /**
     * @param array{
     *   code: string,
     *   expiresAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->expiresAt = $values['expiresAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
