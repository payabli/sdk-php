<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Counts of entities the profile is assigned to. Any non-zero count locks the
 * profile from deletion in the Payabli Portal.
 */
class EntitiesAssigned extends JsonSerializableType
{
    /**
     * @var int $organizations Number of organizations the profile is assigned to.
     */
    #[JsonProperty('organizations')]
    public int $organizations;

    /**
     * @var int $paypoints Number of paypoints the profile is assigned to.
     */
    #[JsonProperty('paypoints')]
    public int $paypoints;

    /**
     * @var int $templates Number of boarding templates the profile is assigned to.
     */
    #[JsonProperty('templates')]
    public int $templates;

    /**
     * @var int $applications Number of boarding applications the profile is assigned to.
     */
    #[JsonProperty('applications')]
    public int $applications;

    /**
     * @param array{
     *   organizations: int,
     *   paypoints: int,
     *   templates: int,
     *   applications: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organizations = $values['organizations'];
        $this->paypoints = $values['paypoints'];
        $this->templates = $values['templates'];
        $this->applications = $values['applications'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
