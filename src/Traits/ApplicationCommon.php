<?php

namespace Payabli\Traits;

use Payabli\Types\RequestedServices;
use Payabli\Types\RepresentativeResponse;
use Payabli\Types\ApplicationLinks;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Fields shared by a boarding application in single-record and list responses.
 *
 * @property string $requestsReference
 * @property string $businessReference
 * @property ?string $externalId
 * @property ?string $parent
 * @property ?string $parentOrgName
 * @property ?string $entityType
 * @property ?string $dbaName
 * @property string $applicationStatus
 * @property int $applicationStatusCode
 * @property array<string> $allowedActions
 * @property ?string $requestTemplate
 * @property ?RequestedServices $services
 * @property ?array<string> $tags
 * @property ?array<RepresentativeResponse> $representatives
 * @property string $createdAt
 * @property ?string $submittedAt
 * @property ApplicationLinks $links
 */
trait ApplicationCommon
{
    /**
     * @var string $requestsReference The application reference, used to read and manage the application.
     */
    #[JsonProperty('requestsReference')]
    public string $requestsReference;

    /**
     * @var string $businessReference The reference of the business being boarded.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @var ?string $externalId An identifier from your own system.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var ?string $parent The reference of the organization the application belongs to.
     */
    #[JsonProperty('parent')]
    public ?string $parent;

    /**
     * @var ?string $parentOrgName The name of the organization the application belongs to.
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $entityType The type of entity being boarded.
     */
    #[JsonProperty('entityType')]
    public ?string $entityType;

    /**
     * @var ?string $dbaName The doing-business-as name.
     */
    #[JsonProperty('dbaName')]
    public ?string $dbaName;

    /**
     * The application's lifecycle status, as a lowercase name. For what moves an application between statuses, see [Boarding application statuses](/guides/pay-ops-boarding-application-status-reference). One of:
     *
     * - `draft` (1): Created and editable. The only status that accepts updates.
     * - `submitted` (2): Submitted with the signature of record.
     * - `verifying` (3): Automated verification is in progress.
     * - `pendingreview` (4): Awaiting underwriting review.
     * - `escalatedreview` (5): Escalated to a higher review tier.
     * - `pendingdocuments` (6): Underwriting requested documents from the applicant.
     * - `pendingresponse` (7): Underwriting asked the applicant a question.
     * - `approved` (8): Approved and waiting for services to be enabled.
     * - `autoapproved` (9): Approved without manual review.
     * - `denied` (10): Denied. Terminal.
     * - `withdrawn` (11): Withdrawn. Terminal.
     * - `abandoned` (12): Reserved. No action moves an application to this status.
     * - `error` (13): Processing hit an error. Payabli can recover the application from this status.
     * - `activated` (14): The requested services are provisioned and live. Terminal. An `approved` or `autoapproved` application moves to `activated` automatically after all requested services are boarded.
     *
     * @var string $applicationStatus
     */
    #[JsonProperty('applicationStatus')]
    public string $applicationStatus;

    /**
     * @var int $applicationStatusCode The numeric code of the application's lifecycle status. See `applicationStatus` for the code of each status.
     */
    #[JsonProperty('applicationStatusCode')]
    public int $applicationStatusCode;

    /**
     * @var array<string> $allowedActions The lifecycle actions currently allowed on the application. The list can include actions that Payabli or its internal services perform, which you can't call through the API.
     */
    #[JsonProperty('allowedActions'), ArrayType(['string'])]
    public array $allowedActions;

    /**
     * @var ?string $requestTemplate The reference of the boarding template applied to the application.
     */
    #[JsonProperty('requestTemplate')]
    public ?string $requestTemplate;

    /**
     * @var ?RequestedServices $services The services the application requests. Left out when the application doesn't request any.
     */
    #[JsonProperty('services')]
    public ?RequestedServices $services;

    /**
     * @var ?array<string> $tags Labels for the application.
     */
    #[JsonProperty('tags'), ArrayType(['string'])]
    public ?array $tags;

    /**
     * @var ?array<RepresentativeResponse> $representatives The representatives assigned to the application.
     */
    #[JsonProperty('representatives'), ArrayType([RepresentativeResponse::class])]
    public ?array $representatives;

    /**
     * @var string $createdAt When the application was created.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @var ?string $submittedAt When the application was submitted.
     */
    #[JsonProperty('submittedAt')]
    public ?string $submittedAt;

    /**
     * @var ApplicationLinks $links Hypermedia links for the application resource.
     */
    #[JsonProperty('_links')]
    public ApplicationLinks $links;
}
