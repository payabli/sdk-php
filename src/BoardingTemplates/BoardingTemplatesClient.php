<?php

namespace Payabli\BoardingTemplates;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\BoardingTemplates\Requests\ListTemplatesBoardingTemplatesRequest;
use Payabli\Types\ListTemplatesResponse;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\Types\Template;
use Payabli\Types\TemplateVersion;

class BoardingTemplatesClient
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
     * Lists the boarding templates an organization owns, plus templates
     * inherited from ancestor organizations. Scope the listing with the
     * required `orgId` query parameter. You can filter by `status`, `name`,
     * `slug`, `orgName`, and `inherited`, and page through results.
     *
     * Example:
     * ```php
     * $client->boardingTemplates->listTemplates(
     *     new ListTemplatesBoardingTemplatesRequest([
     *         'orgId' => 123,
     *     ]),
     * );
     * ```
     *
     * @param ListTemplatesBoardingTemplatesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListTemplatesResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function listTemplates(ListTemplatesBoardingTemplatesRequest $request, ?array $options = null): ?ListTemplatesResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        $query['orgId'] = $request->orgId;
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->name != null) {
            $query['name'] = $request->name;
        }
        if ($request->slug != null) {
            $query['slug'] = $request->slug;
        }
        if ($request->orgName != null) {
            $query['orgName'] = $request->orgName;
        }
        if ($request->inherited != null) {
            $query['inherited'] = $request->inherited;
        }
        if ($request->fromRecord != null) {
            $query['fromRecord'] = $request->fromRecord;
        }
        if ($request->limitRecord != null) {
            $query['limitRecord'] = $request->limitRecord;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "v2/templates",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListTemplatesResponse::fromJson($json);
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
     * Retrieves a boarding template by UUID, including its current content version.
     *
     * Example:
     * ```php
     * $client->boardingTemplates->getTemplate(
     *     '019ff129-d393-7761-9a31-e5afe85b4081',
     * );
     * ```
     *
     * @param string $uuid The template's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?Template
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getTemplate(string $uuid, ?array $options = null): ?Template
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
                    path: "v2/templates/{$uuid}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return Template::fromJson($json);
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
     * Archives a boarding template by UUID. Archiving is a soft delete: the
     * template stays readable with `status: archived`, so archiving an
     * already-archived template returns `409`, not another success. Unknown
     * templates return `404`.
     *
     * Example:
     * ```php
     * $client->boardingTemplates->archiveTemplate(
     *     '019ff129-d393-7761-9a31-e5afe85b4081',
     * );
     * ```
     *
     * @param string $uuid The template's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function archiveTemplate(string $uuid, ?array $options = null): void
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
                    path: "v2/templates/{$uuid}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
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
     * Retrieves a specific immutable content version of a template.
     *
     * Example:
     * ```php
     * $client->boardingTemplates->getTemplateVersion(
     *     '019ff129-d393-7761-9a31-e5afe85b4081',
     *     '019ff129-d396-74c4-86da-ae3d082d7ef9',
     * );
     * ```
     *
     * @param string $uuid The template's UUID.
     * @param string $versionUuid The version's UUID.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TemplateVersion
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getTemplateVersion(string $uuid, string $versionUuid, ?array $options = null): ?TemplateVersion
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
                    path: "v2/templates/{$uuid}/versions/{$versionUuid}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return TemplateVersion::fromJson($json);
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
