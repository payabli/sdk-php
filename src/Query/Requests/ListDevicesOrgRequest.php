<?php

namespace Payabli\Query\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\ExportFormat;

class ListDevicesOrgRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<ExportFormat> $exportFormat
     */
    public ?string $exportFormat;

    /**
     * @var ?int $fromRecord The number of records to skip before starting to collect the result set.
     */
    public ?int $fromRecord;

    /**
     * @var ?int $limitRecord Max number of records to return for the query. Use `0` or negative value to return all records.
     */
    public ?int $limitRecord;

    /**
     *
     * Collection of field names, conditions, and values used to filter
     * the query.
     *
     * <Info>
     *   **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**
     *
     *   Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.
     *
     *   For example:
     *
     *   --url https://api-sandbox.payabli.com/api/Query/devices/org/236?parameters=status=1&limitRecord=20
     *
     *   should become:
     *
     *   --url https://api-sandbox.payabli.com/api/Query/devices/org/236?status=1&limitRecord=20
     * </Info>
     *
     * See [Filters and Conditions
     * Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference)
     * for more information.
     *
     * **List of field names accepted:**
     *
     *
     * - `deviceId` (eq, ne, ct, nct)
     *
     * - `serialNumber` (eq, ne, ct, nct)
     *
     * - `friendlyName` (eq, ne, ct, nct)
     *
     * - `description` (eq, ne, ct, nct)
     *
     * - `model` (eq, ne, ct, nct)
     *
     * - `make` (eq, ne, ct, nct)
     *
     * - `macAddress` (eq, ne, ct, nct)
     *
     * - `registrationCode` (eq, ne, ct, nct)
     *
     * - `status` (eq, ne, in, nin)
     *
     * - `deviceType` (eq, ne, in, nin)
     *
     * - `deviceOs` (eq, ne, in, nin)
     *
     * - `activationAttempts` (eq, ne, gt, ge, lt, le)
     *
     * - `createdDate` (gt, ge, lt, le, eq, ne)
     *
     * - `updatedDate` (gt, ge, lt, le, eq, ne)
     *
     * - `lastHealthCheck` (gt, ge, lt, le, eq, ne)
     *
     * - `activationExpiry` (gt, ge, lt, le, eq, ne). This filter corresponds to the `activationCodeExpiry` response field.
     *
     * - `paypointId` (eq, ne)
     *
     * - `paypointDba` (eq, ne, ct, nct)
     *
     * - `paypointLegal` (eq, ne, ct, nct)
     *
     * - `paypointEntry` (eq, ne, ct, nct)
     *
     * - `externalPaypointId` (eq, ne, ct, nct)
     *
     * - `parentOrgId` (eq, ne)
     *
     * - `parentOrgName` (eq, ne, ct, nct)
     *
     *
     * **List of comparison operators accepted:**
     *
     * - `eq` or empty => equal
     *
     * - `gt` => greater than
     *
     * - `ge` => greater or equal
     *
     * - `lt` => less than
     *
     * - `le` => less or equal
     *
     * - `ne` => not equal
     *
     * - `ct` => contains
     *
     * - `nct` => not contains
     *
     * - `in` => inside array
     *
     * - `nin` => not inside array
     *
     * @var ?array<string, ?string> $parameters
     */
    public ?array $parameters;

    /**
     * @var ?string $sortBy The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
     */
    public ?string $sortBy;

    /**
     * @param array{
     *   exportFormat?: ?value-of<ExportFormat>,
     *   fromRecord?: ?int,
     *   limitRecord?: ?int,
     *   parameters?: ?array<string, ?string>,
     *   sortBy?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->exportFormat = $values['exportFormat'] ?? null;
        $this->fromRecord = $values['fromRecord'] ?? null;
        $this->limitRecord = $values['limitRecord'] ?? null;
        $this->parameters = $values['parameters'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
    }
}
