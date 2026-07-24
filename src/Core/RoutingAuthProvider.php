<?php

namespace Payabli\Core;

/**
 * Routes authentication per-endpoint. Given an endpoint's declared security
 * requirements, it applies the headers for the first requirement whose schemes
 * all have credentials available.
 */
class RoutingAuthProvider
{
    /**
     * @var ?OAuthTokenProvider $oauthTokenProvider
     */
    private ?OAuthTokenProvider $oauthTokenProvider;

    /**
     * @var ?string $apiKey
     */
    private ?string $apiKey;

    /**
     * @param ?OAuthTokenProvider $oauthTokenProvider
     * @param ?string $apiKey
     */
    public function __construct(
        ?OAuthTokenProvider $oauthTokenProvider = null,
        ?string $apiKey = null,
    ) {
        $this->oauthTokenProvider = $oauthTokenProvider;
        $this->apiKey = $apiKey;
    }

    /**
     * Returns the auth headers for the first satisfiable security requirement.
     *
     * @param ?array<array<string, array<string>>> $security The endpoint's security requirements (an OR-list of AND-maps of scheme keys to scopes).
     * @return array<string, string>
     */
    public function getAuthHeaders(?array $security = null): array
    {
        if ($security === null || count($security) === 0) {
            return [];
        }

        /** @var array<string, callable(): array<string, string>> $available */
        $available = [];
        $oauthTokenProvider = $this->oauthTokenProvider;
        if ($oauthTokenProvider !== null) {
            $available['BearerAuth'] = fn (): array => ['Authorization' => "Bearer " . $oauthTokenProvider->getToken()];
        }
        $apiKey = $this->apiKey;
        if ($apiKey !== null) {
            $available['APIKeyAuth'] = fn (): array => ['requestToken' => $apiKey];
        }

        foreach ($security as $requirement) {
            $schemeKeys = array_keys($requirement);
            $satisfiable = true;
            foreach ($schemeKeys as $schemeKey) {
                if (!isset($available[$schemeKey])) {
                    $satisfiable = false;
                    break;
                }
            }
            if ($satisfiable) {
                $headers = [];
                foreach ($schemeKeys as $schemeKey) {
                    $headers = array_merge($headers, $available[$schemeKey]());
                }
                return $headers;
            }
        }

        $requirementHints = [];
        foreach ($security as $requirement) {
            $missing = [];
            foreach (array_keys($requirement) as $schemeKey) {
                if (!isset($available[$schemeKey])) {
                    $missing[] = $schemeKey;
                }
            }
            $requirementHints[] = implode(' AND ', $missing);
        }
        throw new \Exception(
            "No authentication credentials provided that satisfy the endpoint's security requirements. "
            . "Please provide credentials for: " . implode(' OR ', $requirementHints)
        );
    }
}
