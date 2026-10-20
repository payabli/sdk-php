<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The signature details for the application. The signer is the person flagged
 * with `isSigner` on the business, and Payabli records the signer's identity
 * from their person record and business link. Keep the signer's details
 * current with the people endpoints before you submit, because you can't
 * correct them here. Provide a signature with `signature` and
 * `signatureType`, or, if the signer signed in your own e-sign tool, send
 * `signedDocumentReference` instead. Signer identity fields such as `name`,
 * `email`, `ssn`, and `address` aren't part of this object, and Payabli
 * ignores them if you send them.
 */
class SubmitSigner extends JsonSerializableType
{
    /**
     * @var ?string $personReference The reference of an owner linked to this business, to make them the signer before the application is submitted. Works only while the application is a draft. Leave it out when the business already has a signer. If the person isn't linked to this business, the request fails with `404`. If the person isn't an owner, the request fails with `422` and the error `SIGNER_NOT_OWNER`.
     */
    #[JsonProperty('personReference')]
    public ?string $personReference;

    /**
     * @var ?string $signature The signature. For `type` and `checkbox`, send the signer's name. For `draw`, send the image as a base64 data URL, such as the output of `canvas.toDataURL()`. Required unless you send `signedDocumentReference`.
     */
    #[JsonProperty('signature')]
    public ?string $signature;

    /**
     * @var ?value-of<SignatureType> $signatureType How the signer signed. Required with `signature`.
     */
    #[JsonProperty('signatureType')]
    public ?string $signatureType;

    /**
     * @var ?string $signedDocumentReference The reference for a document the signer signed in your own e-sign tool, such as a DocuSign envelope ID. Send it instead of `signature` and `signatureType`.
     */
    #[JsonProperty('signedDocumentReference')]
    public ?string $signedDocumentReference;

    /**
     * @var ?bool $acceptance Whether the signer accepted the terms. If you leave it out, Payabli records `false`.
     */
    #[JsonProperty('acceptance')]
    public ?bool $acceptance;

    /**
     * @var ?bool $pciAttestation Whether the signer attested to PCI compliance. If you leave it out, Payabli records `false`.
     */
    #[JsonProperty('pciAttestation')]
    public ?bool $pciAttestation;

    /**
     * The IP address of the signer's device, as your system saw it. Payabli
     * records it as reported by you, in its own field, and still records the
     * IP address it observes on the request. Send a single IPv4 address in
     * dotted-decimal form, such as `203.0.113.7`, or an IPv6 address in any
     * valid form, up to 45 characters. Payabli rejects ports, CIDR ranges,
     * IPv6 zone IDs, lists of addresses, and shorthand, integer, hex, or
     * leading-zero IPv4 forms. An invalid value returns `400`, and the
     * application isn't submitted. An empty value is treated as not sent.
     *
     * @var ?string $reportedSignerIp
     */
    #[JsonProperty('reportedSignerIp')]
    public ?string $reportedSignerIp;

    /**
     * @var ?array<string, string> $additionalData
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => 'string'])]
    public ?array $additionalData;

    /**
     * @param array{
     *   personReference?: ?string,
     *   signature?: ?string,
     *   signatureType?: ?value-of<SignatureType>,
     *   signedDocumentReference?: ?string,
     *   acceptance?: ?bool,
     *   pciAttestation?: ?bool,
     *   reportedSignerIp?: ?string,
     *   additionalData?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->personReference = $values['personReference'] ?? null;
        $this->signature = $values['signature'] ?? null;
        $this->signatureType = $values['signatureType'] ?? null;
        $this->signedDocumentReference = $values['signedDocumentReference'] ?? null;
        $this->acceptance = $values['acceptance'] ?? null;
        $this->pciAttestation = $values['pciAttestation'] ?? null;
        $this->reportedSignerIp = $values['reportedSignerIp'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
