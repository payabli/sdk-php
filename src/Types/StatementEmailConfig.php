<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Configuration for statement email recipients and the sender address.
 */
class StatementEmailConfig extends JsonSerializableType
{
    /**
     * @var ?string $sender The email address from which statements are sent. Always uses a Payabli domain, for example `acme-partners@payabli.com`. If `null`, `noreply@payabli.com` is used.
     */
    #[JsonProperty('sender')]
    public ?string $sender;

    /**
     * @var ?array<string> $recipients List of email addresses that receive billing statements. These are merchant or partner contacts.
     */
    #[JsonProperty('recipients'), ArrayType(['string'])]
    public ?array $recipients;

    /**
     * @param array{
     *   sender?: ?string,
     *   recipients?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sender = $values['sender'] ?? null;
        $this->recipients = $values['recipients'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
