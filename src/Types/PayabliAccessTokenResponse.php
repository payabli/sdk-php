<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Successful response from the token endpoint. Returns the access token, its lifetime, and any state echoed from the request.
 */
class PayabliAccessTokenResponse extends JsonSerializableType
{
    /**
     * @var string $tokenType The token type. Send the access token in the `Authorization` header as `Bearer <access_token>`.
     */
    #[JsonProperty('token_type')]
    public string $tokenType;

    /**
     * @var string $accessToken The access token to send on subsequent API calls.
     */
    #[JsonProperty('access_token')]
    public string $accessToken;

    /**
     * @var int $expiresIn The token's lifetime in seconds. Request a new token when it expires.
     */
    #[JsonProperty('expires_in')]
    public int $expiresIn;

    /**
     * @var ?string $state The opaque value sent in the request, echoed back. Present only when you send `state` in the request.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @param array{
     *   tokenType: string,
     *   accessToken: string,
     *   expiresIn: int,
     *   state?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tokenType = $values['tokenType'];
        $this->accessToken = $values['accessToken'];
        $this->expiresIn = $values['expiresIn'];
        $this->state = $values['state'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
