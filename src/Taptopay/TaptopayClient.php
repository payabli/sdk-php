<?php

namespace Payabli\Taptopay;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Taptopay\Requests\TapToPayActivationChallengeRequest;
use Payabli\Types\TapToPayActivationChallengeResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class TaptopayClient
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @var ?RoutingAuthProvider $routingAuthProvider @phpstan-ignore-next-line Property is read in endpoint methods and passed to subclients
     */
    private ?RoutingAuthProvider $routingAuthProvider;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     * @param ?RoutingAuthProvider $routingAuthProvider
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
        ?RoutingAuthProvider $routingAuthProvider = null,
    ) {
        $this->client = $client;
        $this->routingAuthProvider = $routingAuthProvider;
        $this->options = $options ?? [];
    }

    /**
     * Issues a short-lived activation code for a Tap to Pay device in the
     * `Pending` state. This endpoint is for Tap to Pay devices only.
     * Deliver the code to the device to complete activation.
     *
     * A code is valid for 30 minutes after it's issued. Calling this
     * endpoint again for the same device before the code expires returns
     * the same code, with `alreadyIssued` set to `true`, instead of
     * generating a new one. A new code is only generated when no valid
     * code exists.
     *
     * Authenticate with an OAuth2 bearer token that has the `pos_create`
     * permission. See [Accept Tap to Pay payments](/guides/pay-in-developer-tap-to-pay)
     * for the full integration guide.
     *
     * Example:
     * ```php
     * $client->taptopay->activationChallenge(
     *     new TapToPayActivationChallengeRequest([
     *         'entry' => '8cfec329267',
     *         'deviceId' => '499585-389fj484-3jcj8hj3',
     *     ]),
     * );
     * ```
     *
     * @param TapToPayActivationChallengeRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TapToPayActivationChallengeResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function activationChallenge(TapToPayActivationChallengeRequest $request, ?array $options = null): ?TapToPayActivationChallengeResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/device/taptopay/activate/challenge",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return TapToPayActivationChallengeResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new PayabliException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new PayabliException(message: $e->getMessage(), previous: $e);
        }
        throw new PayabliApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
