<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\RepresentativeInput;
use Payabli\Types\RequestedServices;

class UpdateApplicationRequest extends JsonSerializableType
{
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
     * @var ?string $requestTemplate The reference of the boarding template to apply.
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
     * @var ?array<string, mixed> $configurations Opaque application-level configuration.
     */
    #[JsonProperty('configurations'), ArrayType(['string' => 'mixed'])]
    public ?array $configurations;

    /**
     * @var ?RequestedServices $services The services to request on the application. Replaces the whole `services` object, so send every service you want to keep. Leave it out to keep the current services.
     */
    #[JsonProperty('services')]
    public ?RequestedServices $services;

    /**
     * @param array{
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
        array $values = [],
    ) {
        $this->externalId = $values['externalId'] ?? null;
        $this->entityType = $values['entityType'] ?? null;
        $this->requestTemplate = $values['requestTemplate'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->representatives = $values['representatives'] ?? null;
        $this->configurations = $values['configurations'] ?? null;
        $this->services = $values['services'] ?? null;
    }
}
