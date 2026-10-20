<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A certification held by the business.
 */
class CertificationDetail extends JsonSerializableType
{
    /**
     * @var ?string $certificationType The type of certification.
     */
    #[JsonProperty('certificationType')]
    public ?string $certificationType;

    /**
     * @var ?string $issuer The organization that issued the certification.
     */
    #[JsonProperty('issuer')]
    public ?string $issuer;

    /**
     * @var ?string $certificateNumber The certificate identifier.
     */
    #[JsonProperty('certificateNumber')]
    public ?string $certificateNumber;

    /**
     * @var ?DateTime $issuedDate The date the certification was issued.
     */
    #[JsonProperty('issuedDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $issuedDate;

    /**
     * @var ?DateTime $expirationDate The date the certification expires.
     */
    #[JsonProperty('expirationDate'), Date(Date::TYPE_DATE)]
    public ?DateTime $expirationDate;

    /**
     * @param array{
     *   certificationType?: ?string,
     *   issuer?: ?string,
     *   certificateNumber?: ?string,
     *   issuedDate?: ?DateTime,
     *   expirationDate?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->certificationType = $values['certificationType'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
        $this->certificateNumber = $values['certificateNumber'] ?? null;
        $this->issuedDate = $values['issuedDate'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
