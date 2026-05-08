<?php

namespace Payabli\Boarding\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Request to create a boarding application linked to an existing paypoint. Used for adding new services to a paypoint without creating a duplicate record.
 */
class CreateApplicationFromPaypointRequest extends JsonSerializableType
{
    /**
     * @var int $paypointId ID of the existing paypoint to link to this application.
     */
    #[JsonProperty('paypointId')]
    public int $paypointId;

    /**
     * @var int $templateId ID of the boarding template to use for the new application.
     */
    #[JsonProperty('templateId')]
    public int $templateId;

    /**
     * @var string $recipientEmail Email address where the boarding link is sent. Required. If you don't want to email the merchant, send to an internal address and use `returnBoardingAccessInfoInLine` to retrieve the link from the response instead.
     */
    #[JsonProperty('recipientEmail')]
    public string $recipientEmail;

    /**
     * @var ?bool $returnBoardingAccessInfoInLine When `true`, returns the boarding access information directly in the response.
     */
    #[JsonProperty('returnBoardingAccessInfoInLine')]
    public ?bool $returnBoardingAccessInfoInLine;

    /**
     * @var ?array<string> $onCreate Additional actions to trigger when the application is created. Currently only `submitApplication` is supported, which automatically submits the application on creation and skips the draft state.
     */
    #[JsonProperty('onCreate'), ArrayType(['string'])]
    public ?array $onCreate;

    /**
     * @param array{
     *   paypointId: int,
     *   templateId: int,
     *   recipientEmail: string,
     *   returnBoardingAccessInfoInLine?: ?bool,
     *   onCreate?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paypointId = $values['paypointId'];
        $this->templateId = $values['templateId'];
        $this->recipientEmail = $values['recipientEmail'];
        $this->returnBoardingAccessInfoInLine = $values['returnBoardingAccessInfoInLine'] ?? null;
        $this->onCreate = $values['onCreate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
