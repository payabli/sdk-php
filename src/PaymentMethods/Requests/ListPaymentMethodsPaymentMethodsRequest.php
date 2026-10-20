<?php

namespace Payabli\PaymentMethods\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\PaymentMethodOwnerType;

class ListPaymentMethodsPaymentMethodsRequest extends JsonSerializableType
{
    /**
     * @var ?string $accountOwner Filter by the entity that owns the payment method.
     */
    public ?string $accountOwner;

    /**
     * @var ?value-of<PaymentMethodOwnerType> $ownerType Filter by owner type.
     */
    public ?string $ownerType;

    /**
     * @var ?string $status Filter by payment method status.
     */
    public ?string $status;

    /**
     * @var ?string $type Filter by payment method type.
     */
    public ?string $type;

    /**
     * @var ?int $limit Number of results per page.
     */
    public ?int $limit;

    /**
     * @var ?int $page Page number to return.
     */
    public ?int $page;

    /**
     * @var ?string $sortBy Field to sort by.
     */
    public ?string $sortBy;

    /**
     * @var ?string $sortOrder Sort direction.
     */
    public ?string $sortOrder;

    /**
     * @param array{
     *   accountOwner?: ?string,
     *   ownerType?: ?value-of<PaymentMethodOwnerType>,
     *   status?: ?string,
     *   type?: ?string,
     *   limit?: ?int,
     *   page?: ?int,
     *   sortBy?: ?string,
     *   sortOrder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountOwner = $values['accountOwner'] ?? null;
        $this->ownerType = $values['ownerType'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->sortBy = $values['sortBy'] ?? null;
        $this->sortOrder = $values['sortOrder'] ?? null;
    }
}
