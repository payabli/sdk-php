<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The result of a lifecycle action, with the application's new status.
 */
class TransitionResult extends JsonSerializableType
{
    /**
     * @var string $requestsReference The application reference.
     */
    #[JsonProperty('requestsReference')]
    public string $requestsReference;

    /**
     * @var string $applicationStatus The application's lifecycle status after the action. See the application object for the list of statuses.
     */
    #[JsonProperty('applicationStatus')]
    public string $applicationStatus;

    /**
     * @var array<string> $allowedActions The lifecycle actions now allowed on the application. The list can include actions that Payabli or its internal services perform, which you can't call through the API.
     */
    #[JsonProperty('allowedActions'), ArrayType(['string'])]
    public array $allowedActions;

    /**
     * @param array{
     *   requestsReference: string,
     *   applicationStatus: string,
     *   allowedActions: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requestsReference = $values['requestsReference'];
        $this->applicationStatus = $values['applicationStatus'];
        $this->allowedActions = $values['allowedActions'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
