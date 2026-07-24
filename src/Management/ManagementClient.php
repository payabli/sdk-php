<?php

namespace Payabli\Management;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\Management\Requests\VerifyAccountDetailsRequest;
use Payabli\Types\VerifyAccountDetailsResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class ManagementClient
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
     * Verifies a bank account and returns detailed verification results from the verification network, including bank name, account status, and response codes. Unlike a pass/fail verification, this endpoint returns granular data to support decision-making and troubleshooting.
     *
     * When bank authentication is enabled for the paypoint's organization, the endpoint performs an identity verification check on the account holder. Otherwise, it performs an account existence check. When bank authentication is enabled, the `accountHolderType` and `holderName` fields are required.
     *
     * Requires `inboundpayments_create` or `outboundpayments_create` permission.
     *
     * Example:
     * ```php
     * $client->management->verifyAccountDetails(
     *     '8cfec329267',
     *     new VerifyAccountDetailsRequest([
     *         'routingNumber' => '122105278',
     *         'accountNumber' => '0000000016',
     *         'accountType' => 'Checking',
     *         'country' => 'US',
     *         'accountHolderType' => 'personal',
     *         'holderName' => 'Jane Doe',
     *     ]),
     * );
     * ```
     *
     * @param string $entry The paypoint's entry name identifier.
     * @param VerifyAccountDetailsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VerifyAccountDetailsResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function verifyAccountDetails(string $entry, VerifyAccountDetailsRequest $request, ?array $options = null): ?VerifyAccountDetailsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "Management/verifyAccountDetails/{$entry}",
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
                return VerifyAccountDetailsResponse::fromJson($json);
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
