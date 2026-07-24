<?php

namespace Payabli\GhostCard;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\GhostCard\Requests\CreateGhostCardRequestBody;
use Payabli\Types\CreateGhostCardResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\GhostCard\Requests\UpdateCardRequestBody;
use Payabli\Types\PayabliApiResponse;

class GhostCardClient
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
     * Creates a ghost card, a multi-use virtual debit card issued to a vendor for recurring or discretionary spend.
     *
     * Unlike single-use virtual cards issued as part of a payout transaction, ghost cards aren't tied to a specific payout. They're issued directly to a vendor and can be reused up to a configurable number of times within the card's spending limits.
     *
     * Only one ghost card can exist per vendor per paypoint. To issue a new card to the same vendor, cancel the existing card first.
     *
     * Example:
     * ```php
     * $client->ghostCard->createGhostCard(
     *     '8cfec329267',
     *     new CreateGhostCardRequestBody([
     *         'vendorId' => 456,
     *         'expenseLimit' => 500,
     *         'amount' => 500,
     *         'maxNumberOfUses' => 3,
     *         'exactAmount' => false,
     *         'expenseLimitPeriod' => 'monthly',
     *         'billingCycle' => 'monthly',
     *         'billingCycleDay' => '1',
     *         'dailyTransactionCount' => 5,
     *         'dailyAmountLimit' => 200,
     *         'transactionAmountLimit' => 100,
     *         'mcc' => '5411',
     *         'tcc' => 'R',
     *         'misc1' => 'PO-98765',
     *         'misc2' => 'Dept-Finance',
     *     ]),
     * );
     * ```
     *
     * @param string $entry The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param CreateGhostCardRequestBody $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateGhostCardResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function createGhostCard(string $entry, CreateGhostCardRequestBody $request, ?array $options = null): ?CreateGhostCardResponse
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
                    path: "MoneyOutCard/GhostCard/{$entry}",
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
                return CreateGhostCardResponse::fromJson($json);
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

    /**
     * Updates the status of a virtual card (including ghost cards) under a paypoint.
     *
     * Example:
     * ```php
     * $client->ghostCard->updateCard(
     *     '8cfec329267',
     *     new UpdateCardRequestBody([
     *         'cardToken' => 'gc_abc123def456',
     *         'status' => CardStatus::Cancelled->value,
     *     ]),
     * );
     * ```
     *
     * @param string $entry The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
     * @param UpdateCardRequestBody $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updateCard(string $entry, UpdateCardRequestBody $request, ?array $options = null): ?PayabliApiResponse
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
                    path: "MoneyOutCard/card/{$entry}",
                    method: HttpMethod::PATCH,
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
                return PayabliApiResponse::fromJson($json);
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
