<?php

namespace Payabli\People\Requests;

use Payabli\Core\Json\JsonSerializableType;

class SearchPeopleRequest extends JsonSerializableType
{
    /**
     * @var string $entry The entry name of your organization, from `OrgEntryName` on the organization. With a paypoint's entry name instead, the search covers only that paypoint's business.
     */
    public string $entry;

    /**
     * @var int $orgId The ID of your organization.
     */
    public int $orgId;

    /**
     * @var (
     *    mixed
     * ) $body
     */
    public mixed $body;

    /**
     * @param array{
     *   entry: string,
     *   orgId: int,
     *   body: (
     *    mixed
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->entry = $values['entry'];
        $this->orgId = $values['orgId'];
        $this->body = $values['body'];
    }
}
