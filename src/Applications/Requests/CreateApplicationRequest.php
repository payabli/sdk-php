<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\RepresentativeInput;
use Payabli\Types\RequestedServices;

class CreateApplicationRequest extends JsonSerializableType
{
    /**
     * @var string $businessReference The reference of the business to board. The business must have a paypoint.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @var ?string $paypointReference The reference of the paypoint to board. Defaults to the business's paypoint when omitted.
     */
    #[JsonProperty('paypointReference')]
    public ?string $paypointReference;

    /**
     * @var ?string $externalId An optional identifier from your own system.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var ?string $entityType The type of entity being boarded.
     */
    #[JsonProperty('entityType')]
    public ?string $entityType;

    /**
     * @var ?string $requestTemplate The reference of the boarding template to apply. Send one on every application. Payabli assigns the underwriting policy from the template, so a submitted application without one fails in review.
     */
    #[JsonProperty('requestTemplate')]
    public ?string $requestTemplate;

    /**
     * @var ?array<string> $tags Optional labels for the application.
     */
    #[JsonProperty('tags'), ArrayType(['string'])]
    public ?array $tags;

    /**
     * @var ?array<RepresentativeInput> $representatives The sales or service representatives assigned to the application.
     */
    #[JsonProperty('representatives'), ArrayType([RepresentativeInput::class])]
    public ?array $representatives;

    /**
     * @var ?array<string, mixed> $configurations Opaque application-level configuration. Null when not supplied.
     */
    #[JsonProperty('configurations'), ArrayType(['string' => 'mixed'])]
    public ?array $configurations;

    /**
     * @var ?RequestedServices $services The services to request on the application.
     */
    #[JsonProperty('services')]
    public ?RequestedServices $services;

    /**
     * @param array{
     *   businessReference: string,
     *   paypointReference?: ?string,
     *   externalId?: ?string,
     *   entityType?: ?string,
     *   requestTemplate?: ?string,
     *   tags?: ?array<string>,
     *   representatives?: ?array<RepresentativeInput>,
     *   configurations?: ?array<string, mixed>,
     *   services?: ?RequestedServices,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessReference = $values['businessReference'];
        $this->paypointReference = $values['paypointReference'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->entityType = $values['entityType'] ?? null;
        $this->requestTemplate = $values['requestTemplate'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->representatives = $values['representatives'] ?? null;
        $this->configurations = $values['configurations'] ?? null;
        $this->services = $values['services'] ?? null;
    }
}
