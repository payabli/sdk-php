<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Configuration for which ACH SEC codes the user is allowed to use.
 */
class AchSetup extends JsonSerializableType
{
    /**
     * CCD is an ACH SEC Code that can be used in ACH transactions by the
     * user that indicates the transaction is a Corporate Credit or Debit
     * Entry.
     *
     * @var ?bool $acceptCcd
     */
    #[JsonProperty('acceptCCD')]
    public ?bool $acceptCcd;

    /**
     * PPD is an ACH SEC Code that can be used in ACH transactions by the
     * user that indicates the transaction is a Prearranged Payment and
     * Deposit.
     *
     * @var ?bool $acceptPpd
     */
    #[JsonProperty('acceptPPD')]
    public ?bool $acceptPpd;

    /**
     * Web is an ACH SEC Code that can be used in ACH transactions by the
     * user that indicates the transaction is an Internet-Initiated/Mobile
     * Entry.
     *
     * @var ?bool $acceptWeb
     */
    #[JsonProperty('acceptWeb')]
    public ?bool $acceptWeb;

    /**
     * @param array{
     *   acceptCcd?: ?bool,
     *   acceptPpd?: ?bool,
     *   acceptWeb?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->acceptCcd = $values['acceptCcd'] ?? null;
        $this->acceptPpd = $values['acceptPpd'] ?? null;
        $this->acceptWeb = $values['acceptWeb'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
