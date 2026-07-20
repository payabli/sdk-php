<?php

namespace Payabli\Token\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class CreateServerSideTokenRequest extends JsonSerializableType
{
    /**
     * @var string $clientId The client ID issued for your integration when credentials are provisioned in the Payabli Portal.
     */
    #[JsonProperty('clientId')]
    public string $clientId;

    /**
     * @var string $clientSecret The client secret issued alongside the client ID. Keep it on your backend and never expose it in client-side code.
     */
    #[JsonProperty('clientSecret')]
    public string $clientSecret;

    /**
     * @var ?string $state An optional opaque value echoed back in the response. Use it to correlate the request with its response.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?array<string> $permissions An optional array of permission IDs that scopes the token to a subset of the credential's granted permissions. When omitted, the token carries all permissions granted to the credential.
     */
    #[JsonProperty('permissions'), ArrayType(['string'])]
    public ?array $permissions;

    /**
     * @param array{
     *   clientId: string,
     *   clientSecret: string,
     *   state?: ?string,
     *   permissions?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'];
        $this->state = $values['state'] ?? null;
        $this->permissions = $values['permissions'] ?? null;
    }
}
