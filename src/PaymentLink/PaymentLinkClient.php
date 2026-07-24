<?php

namespace Payabli\PaymentLink;

use Psr\Http\Client\ClientInterface;
use Payabli\Core\Client\RawClient;
use Payabli\Core\RoutingAuthProvider;
use Payabli\PaymentLink\Requests\PayLinkDataInvoice;
use Payabli\Types\PayabliApiResponsePaymentLinks;
use Payabli\Exceptions\PayabliException;
use Payabli\Exceptions\PayabliApiException;
use Payabli\Core\Json\JsonApiRequest;
use Payabli\Environments;
use Payabli\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Payabli\PaymentLink\Requests\PayLinkDataBill;
use Payabli\Types\GetPayLinkFromIdResponse;
use Payabli\Types\PushPayLinkRequest;
use Payabli\PaymentLink\Requests\RefreshPayLinkFromIdRequest;
use Payabli\PaymentLink\Requests\SendPayLinkFromIdRequest;
use Payabli\PaymentLink\Requests\PayLinkUpdateData;
use Payabli\PaymentLink\Requests\PayLinkDataOut;
use Payabli\PaymentLink\Requests\PatchOutPaymentLinkRequest;
use Payabli\Types\PaymentPageRequestBodyOut;

class PaymentLinkClient
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
     * Generates a payment link for an invoice from the invoice ID.
     *
     * The payment page configuration blocks (`logo`, `page`, `paymentMethods`, `review`, `messageBeforePaying`, `paymentButton`, `notes`, `contactUs`, and `settings`) are optional. When you omit a block, Payabli applies a default rather than hiding it. The block is enabled at a fixed display order, so the generated page stays complete and branded. To hide a section, send the block explicitly with `enabled` set to `false`. An explicit value is always honored and is never replaced by a default. For each block's default, see its description in the request body.
     *
     * Example:
     * ```php
     * $client->paymentLink->addPayLinkFromInvoice(
     *     23548884,
     *     new PayLinkDataInvoice([
     *         'mail2' => 'jo@example.com; ceo@example.com',
     *         'contactUs' => new ContactElement([
     *             'emailLabel' => 'Email',
     *             'enabled' => true,
     *             'header' => 'Contact Us',
     *             'order' => 0,
     *             'paymentIcons' => true,
     *             'phoneLabel' => 'Phone',
     *         ]),
     *         'invoices' => new InvoiceElement([
     *             'enabled' => true,
     *             'invoiceLink' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'View Invoice',
     *                 'order' => 0,
     *             ]),
     *             'order' => 0,
     *             'viewInvoiceDetails' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'Invoice Details',
     *                 'order' => 0,
     *             ]),
     *         ]),
     *         'logo' => new Element([
     *             'enabled' => true,
     *             'order' => 0,
     *         ]),
     *         'messageBeforePaying' => new LabelElement([
     *             'enabled' => true,
     *             'label' => 'Please review your payment details',
     *             'order' => 0,
     *         ]),
     *         'notes' => new NoteElement([
     *             'enabled' => true,
     *             'header' => 'Additional Notes',
     *             'order' => 0,
     *             'placeholder' => 'Enter any additional notes here',
     *             'value' => '',
     *         ]),
     *         'page' => new PageElement([
     *             'description' => 'Complete your payment securely',
     *             'enabled' => true,
     *             'header' => 'Payment Page',
     *             'order' => 0,
     *         ]),
     *         'paymentButton' => new LabelElement([
     *             'enabled' => true,
     *             'label' => 'Pay Now',
     *             'order' => 0,
     *         ]),
     *         'paymentMethods' => new MethodElement([
     *             'allMethodsChecked' => true,
     *             'enabled' => true,
     *             'header' => 'Payment Methods',
     *             'methods' => new MethodsList([
     *                 'amex' => true,
     *                 'applePay' => true,
     *                 'discover' => true,
     *                 'eCheck' => true,
     *                 'mastercard' => true,
     *                 'visa' => true,
     *             ]),
     *             'order' => 0,
     *             'settings' => new MethodElementSettings([
     *                 'applePay' => new MethodElementSettingsApplePay([
     *                     'buttonStyle' => MethodElementSettingsApplePayButtonStyle::Black->value,
     *                     'buttonType' => MethodElementSettingsApplePayButtonType::Pay->value,
     *                     'language' => MethodElementSettingsApplePayLanguage::EnUs->value,
     *                 ]),
     *             ]),
     *         ]),
     *         'payor' => new PayorElement([
     *             'enabled' => true,
     *             'fields' => [
     *                 new PayorFields([
     *                     'display' => true,
     *                     'fixed' => true,
     *                     'identifier' => true,
     *                     'label' => 'Full Name',
     *                     'name' => 'fullName',
     *                     'order' => 0,
     *                     'required' => true,
     *                     'validation' => 'alpha',
     *                     'value' => '',
     *                     'width' => 0,
     *                 ]),
     *             ],
     *             'header' => 'Payor Information',
     *             'order' => 0,
     *         ]),
     *         'review' => new HeaderElement([
     *             'enabled' => true,
     *             'header' => 'Review Payment',
     *             'order' => 0,
     *         ]),
     *         'settings' => new PagelinkSetting([
     *             'color' => '#000000',
     *             'customCssUrl' => 'https://example.com/custom.css',
     *             'language' => 'en',
     *             'pageLogo' => new FileContent([
     *                 'fContent' => 'PHN2ZyB2aWV3Qm94PSIwIDAgODAwIDEwMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPCEtLSBCYWNrZ3JvdW5kIC0tPgogIDxyZWN0IHdpZHRoPSI4MDAiIGhlaWdodD0iMTAwMCIgZmlsbD0id2hpdGUiLz4KICAKICA8IS0tIENvbXBhbnkgSGVhZGVyIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+R3J1enlhIEFkdmVudHVyZSBPdXRmaXR0ZXJzPC90ZXh0PgogIDxsaW5lIHgxPSI0MCIgeTE9IjgwIiB4Mj0iNzYwIiB5Mj0iODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIyIi8+CiAgCiAgPCEtLSBDb21wYW55IERldGFpbHMgLS0+CiAgPHRleHQgeD0iNDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xMjMgTW91bnRhaW4gVmlldyBSb2FkPC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxMzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGJpbGlzaSwgR2VvcmdpYSAwMTA1PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGVsOiArOTk1IDMyIDEyMyA0NTY3PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+RW1haWw6IGluZm9AZ3J1enlhYWR2ZW50dXJlcy5jb208L3RleHQ+CgogIDwhLS0gSW52b2ljZSBUaXRsZSAtLT4KICA8dGV4dCB4PSI2MDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+SU5WT0lDRTwvdGV4dD4KICA8dGV4dCB4PSI2MDAiIHk9IjE0MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5EYXRlOiAxMi8xMS8yMDI0PC90ZXh0PgogIDx0ZXh0IHg9IjYwMCIgeT0iMTYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkludm9pY2UgIzogR1JaLTIwMjQtMTEyMzwvdGV4dD4KCiAgPCEtLSBCaWxsIFRvIFNlY3Rpb24gLS0+CiAgPHRleHQgeD0iNDAiIHk9IjIyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+QklMTCBUTzo8L3RleHQ+CiAgPHJlY3QgeD0iNDAiIHk9IjIzNSIgd2lkdGg9IjMwMCIgaGVpZ2h0PSI4MCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSIyNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0N1c3RvbWVyIE5hbWVdPC90ZXh0PgogIDx0ZXh0IHg9IjUwIiB5PSIyODAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0FkZHJlc3MgTGluZSAxXTwvdGV4dD4KICA8dGV4dCB4PSI1MCIgeT0iMzAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPltDaXR5LCBDb3VudHJ5XTwvdGV4dD4KCiAgPCEtLSBUYWJsZSBIZWFkZXJzIC0tPgogIDxyZWN0IHg9IjQwIiB5PSIzNDAiIHdpZHRoPSI3MjAiIGhlaWdodD0iMzAiIGZpbGw9IiMyYzNlNTAiLz4KICA8dGV4dCB4PSI1MCIgeT0iMzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSJ3aGl0ZSI+RGVzY3JpcHRpb248L3RleHQ+CiAgPHRleHQgeD0iNDUwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5RdWFudGl0eTwvdGV4dD4KICA8dGV4dCB4PSI1NTAiIHk9IjM2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPlJhdGU8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5BbW91bnQ8L3RleHQ+CgogIDwhLS0gVGFibGUgUm93cyAtLT4KICA8cmVjdCB4PSI0MCIgeT0iMzcwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZjdmOWZhIi8+CiAgPHRleHQgeD0iNTAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5Nb3VudGFpbiBDbGltYmluZyBFcXVpcG1lbnQgUmVudGFsPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iMzkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSIzOTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDI1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMjUwLjAwPC90ZXh0PgoKICA8cmVjdCB4PSI0MCIgeT0iNDAwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSJ3aGl0ZSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+R3VpZGVkIFRyZWsgUGFja2FnZSAtIDIgRGF5czwvdGV4dD4KICA8dGV4dCB4PSI0NTAiIHk9IjQyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNDIwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQ0MDAuMDA8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDQwMC4wMDwvdGV4dD4KCiAgPHJlY3QgeD0iNDAiIHk9IjQzMCIgd2lkdGg9IjcyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U2FmZXR5IEVxdWlwbWVudCBQYWNrYWdlPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iNDUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDE1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjQ1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMTUwLjAwPC90ZXh0PgoKICA8IS0tIFRvdGFscyAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI0ODAiIHgyPSI3NjAiIHkyPSI0ODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNTUwIiB5PSI1MTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMzNDQ5NWUiPlN1YnRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjUxMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kODAwLjAwPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSIjMzQ0OTVlIj5UYXggKDE4JSk6PC90ZXh0PgogIDx0ZXh0IHg9IjY4MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQxNDQuMDA8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI1NzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjU3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+JDk0NC4wMDwvdGV4dD4KCiAgPCEtLSBQYXltZW50IFRlcm1zIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2NDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlBheW1lbnQgVGVybXM8L3RleHQ+CiAgPHRleHQgeD0iNDAiIHk9IjY3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5QYXltZW50IGlzIGR1ZSB3aXRoaW4gMzAgZGF5czwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNjkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPlBsZWFzZSBpbmNsdWRlIGludm9pY2UgbnVtYmVyIG9uIHBheW1lbnQ8L3RleHQ+CgogIDwhLS0gQmFuayBEZXRhaWxzIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI3MzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPkJhbmsgRGV0YWlsczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkJhbms6IEJhbmsgb2YgR2VvcmdpYTwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPklCQU46IEdFMTIzNDU2Nzg5MDEyMzQ1Njc4PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSI4MDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U1dJRlQ6IEJBR0FHRTIyPC90ZXh0PgoKICA8IS0tIEZvb3RlciAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI5MDAiIHgyPSI3NjAiIHkyPSI5MDAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNDAiIHk9IjkzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjN2Y4YzhkIj5UaGFuayB5b3UgZm9yIGNob29zaW5nIEdydXp5YSBBZHZlbnR1cmUgT3V0Zml0dGVyczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iOTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM3ZjhjOGQiPnd3dy5ncnV6eWFhZHZlbnR1cmVzLmNvbTwvdGV4dD4KPC9zdmc+Cg==',
     *                 'filename' => 'logo.jpg',
     *                 'ftype' => FileContentFtype::Jpg->value,
     *                 'furl' => '',
     *             ]),
     *             'redirectAfterApprove' => true,
     *             'redirectAfterApproveUrl' => 'https://example.com/success',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $idInvoice Invoice ID
     * @param PayLinkDataInvoice $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addPayLinkFromInvoice(int $idInvoice, PayLinkDataInvoice $request, ?array $options = null): ?PayabliApiResponsePaymentLinks
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->amountFixed != null) {
            $query['amountFixed'] = $request->amountFixed;
        }
        if ($request->mail2 != null) {
            $query['mail2'] = $request->mail2;
        }
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentLink/{$idInvoice}",
                    method: HttpMethod::POST,
                    headers: $headers,
                    query: $query,
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Generates a payment link for a bill from the bill ID. The vendor receives a secure page where they can select their preferred payment method (ACH, virtual card, or check) and complete the payment.
     *
     * Example:
     * ```php
     * $client->paymentLink->addPayLinkFromBill(
     *     54323,
     *     new PayLinkDataBill([
     *         'mail2' => 'jo@example.com; ceo@example.com',
     *         'body' => new PaymentPageRequestBodyOut([
     *             'contactUs' => new ContactElement([
     *                 'emailLabel' => 'Email',
     *                 'enabled' => true,
     *                 'header' => 'Contact Us',
     *                 'order' => 0,
     *                 'paymentIcons' => true,
     *                 'phoneLabel' => 'Phone',
     *             ]),
     *             'logo' => new Element([
     *                 'enabled' => true,
     *                 'order' => 0,
     *             ]),
     *             'messageBeforePaying' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'Please review your payment details',
     *                 'order' => 0,
     *             ]),
     *             'notes' => new NoteElement([
     *                 'enabled' => true,
     *                 'header' => 'Additional Notes',
     *                 'order' => 0,
     *                 'placeholder' => 'Enter any additional notes here',
     *                 'value' => '',
     *             ]),
     *             'page' => new PageElement([
     *                 'description' => 'Get paid securely',
     *                 'enabled' => true,
     *                 'header' => 'Payment Page',
     *                 'order' => 0,
     *             ]),
     *             'paymentButton' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'Pay Now',
     *                 'order' => 0,
     *             ]),
     *             'paymentMethods' => new MethodElementOut([
     *                 'allMethodsChecked' => true,
     *                 'allowMultipleMethods' => true,
     *                 'defaultMethod' => 'vcard',
     *                 'enabled' => true,
     *                 'header' => 'Payment Methods',
     *                 'methods' => new MethodsListOut([
     *                     'ach' => true,
     *                     'check' => true,
     *                     'vcard' => true,
     *                 ]),
     *                 'order' => 0,
     *                 'showPreviewVirtualCard' => true,
     *             ]),
     *             'review' => new HeaderElement([
     *                 'enabled' => true,
     *                 'header' => 'Review Payment',
     *                 'order' => 0,
     *             ]),
     *             'settings' => new PagelinkSetting([
     *                 'color' => '#000000',
     *                 'language' => 'en',
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $billId The Payabli ID for the bill.
     * @param PayLinkDataBill $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addPayLinkFromBill(int $billId, PayLinkDataBill $request, ?array $options = null): ?PayabliApiResponsePaymentLinks
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->amountFixed != null) {
            $query['amountFixed'] = $request->amountFixed;
        }
        if ($request->mail2 != null) {
            $query['mail2'] = $request->mail2;
        }
        $headers = [];
        if ($request->idempotencyKey != null) {
            $headers['idempotencyKey'] = $request->idempotencyKey;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentLink/bill/{$billId}",
                    method: HttpMethod::POST,
                    headers: $headers,
                    query: $query,
                    body: $request->body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Deletes a payment link by ID.
     *
     * Example:
     * ```php
     * $client->paymentLink->deletePayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     * );
     * ```
     *
     * @param string $payLinkId ID for the payment link.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function deletePayLinkFromId(string $payLinkId, ?array $options = null): ?PayabliApiResponsePaymentLinks
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
                    path: "PaymentLink/{$payLinkId}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Retrieves a payment link by ID.
     *
     * Example:
     * ```php
     * $client->paymentLink->getPayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     * );
     * ```
     *
     * @param string $paylinkId ID for payment link
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetPayLinkFromIdResponse
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function getPayLinkFromId(string $paylinkId, ?array $options = null): ?GetPayLinkFromIdResponse
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
                    path: "PaymentLink/load/{$paylinkId}",
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
                return GetPayLinkFromIdResponse::fromJson($json);
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
     * Send a payment link to the specified email addresses or phone numbers.
     *
     * Example:
     * ```php
     * $client->paymentLink->pushPayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     PushPayLinkRequest::sms(new PushPayLinkRequestSms([])),
     * );
     * ```
     *
     * @param string $payLinkId ID for the payment link.
     * @param PushPayLinkRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function pushPayLinkFromId(string $payLinkId, PushPayLinkRequest $request, ?array $options = null): ?PayabliApiResponsePaymentLinks
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
                    path: "PaymentLink/push/{$payLinkId}",
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Refresh a payment link's content after an update.
     *
     * Example:
     * ```php
     * $client->paymentLink->refreshPayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     new RefreshPayLinkFromIdRequest([]),
     * );
     * ```
     *
     * @param string $payLinkId ID for the payment link.
     * @param RefreshPayLinkFromIdRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function refreshPayLinkFromId(string $payLinkId, RefreshPayLinkFromIdRequest $request = new RefreshPayLinkFromIdRequest(), ?array $options = null): ?PayabliApiResponsePaymentLinks
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->amountFixed != null) {
            $query['amountFixed'] = $request->amountFixed;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentLink/refresh/{$payLinkId}",
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Sends a payment link to the specified email addresses.
     *
     * Example:
     * ```php
     * $client->paymentLink->sendPayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     new SendPayLinkFromIdRequest([
     *         'mail2' => 'jo@example.com; ceo@example.com',
     *     ]),
     * );
     * ```
     *
     * @param string $payLinkId ID for the payment link.
     * @param SendPayLinkFromIdRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function sendPayLinkFromId(string $payLinkId, SendPayLinkFromIdRequest $request = new SendPayLinkFromIdRequest(), ?array $options = null): ?PayabliApiResponsePaymentLinks
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        if ($request->attachfile != null) {
            $query['attachfile'] = $request->attachfile;
        }
        if ($request->mail2 != null) {
            $query['mail2'] = $request->mail2;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentLink/send/{$payLinkId}",
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Updates a payment link's details.
     *
     * Example:
     * ```php
     * $client->paymentLink->updatePayLinkFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     new PayLinkUpdateData([
     *         'notes' => new NoteElement([
     *             'enabled' => true,
     *             'header' => 'Additional Notes',
     *             'order' => 0,
     *             'placeholder' => 'Enter any additional notes here',
     *             'value' => '',
     *         ]),
     *         'paymentButton' => new LabelElement([
     *             'enabled' => true,
     *             'label' => 'Pay Now',
     *             'order' => 0,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $payLinkId ID for the payment link.
     * @param PayLinkUpdateData $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePayLinkFromId(string $payLinkId, PayLinkUpdateData $request = new PayLinkUpdateData(), ?array $options = null): ?PayabliApiResponsePaymentLinks
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
                    path: "PaymentLink/update/{$payLinkId}",
                    method: HttpMethod::PUT,
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Generates a vendor payment link for a specific bill lot number. This allows you to pay all bills with the same lot number for a vendor with a single payment link.
     *
     * Example:
     * ```php
     * $client->paymentLink->addPayLinkFromBillLotNumber(
     *     'LOT-2024-001',
     *     new PayLinkDataOut([
     *         'entryPoint' => '8cfec329267',
     *         'vendorNumber' => 'VEN-123',
     *         'mail2' => 'customer@example.com; billing@example.com',
     *         'amountFixed' => 'true',
     *         'body' => new PaymentPageRequestBodyOut([
     *             'contactUs' => new ContactElement([
     *                 'emailLabel' => 'Email',
     *                 'enabled' => true,
     *                 'header' => 'Contact Us',
     *                 'order' => 0,
     *                 'paymentIcons' => true,
     *                 'phoneLabel' => 'Phone',
     *             ]),
     *             'logo' => new Element([
     *                 'enabled' => true,
     *                 'order' => 0,
     *             ]),
     *             'messageBeforePaying' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'Please review your payment details',
     *                 'order' => 0,
     *             ]),
     *             'notes' => new NoteElement([
     *                 'enabled' => true,
     *                 'header' => 'Additional Notes',
     *                 'order' => 0,
     *                 'placeholder' => 'Enter any additional notes here',
     *                 'value' => '',
     *             ]),
     *             'page' => new PageElement([
     *                 'description' => 'Get paid securely',
     *                 'enabled' => true,
     *                 'header' => 'Payment Page',
     *                 'order' => 0,
     *             ]),
     *             'paymentButton' => new LabelElement([
     *                 'enabled' => true,
     *                 'label' => 'Pay Now',
     *                 'order' => 0,
     *             ]),
     *             'paymentMethods' => new MethodElementOut([
     *                 'allMethodsChecked' => true,
     *                 'allowMultipleMethods' => true,
     *                 'defaultMethod' => 'vcard',
     *                 'enabled' => true,
     *                 'header' => 'Payment Methods',
     *                 'methods' => new MethodsListOut([
     *                     'ach' => true,
     *                     'check' => true,
     *                     'vcard' => true,
     *                 ]),
     *                 'order' => 0,
     *                 'showPreviewVirtualCard' => true,
     *             ]),
     *             'review' => new HeaderElement([
     *                 'enabled' => true,
     *                 'header' => 'Review Payment',
     *                 'order' => 0,
     *             ]),
     *             'settings' => new PagelinkSetting([
     *                 'color' => '#000000',
     *                 'language' => 'en',
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $lotNumber Lot number of the bills to pay. All bills with this lot number will be included.
     * @param PayLinkDataOut $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function addPayLinkFromBillLotNumber(string $lotNumber, PayLinkDataOut $request, ?array $options = null): ?PayabliApiResponsePaymentLinks
    {
        $options = array_merge($this->options, $options ?? []);
        $options['headers'] = array_merge(
            $this->routingAuthProvider?->getAuthHeaders([['BearerAuth' => []], ['APIKeyAuth' => []]]) ?? [],
            $options['headers'] ?? []
        );
        $query = [];
        $query['entryPoint'] = $request->entryPoint;
        $query['vendorNumber'] = $request->vendorNumber;
        if ($request->mail2 != null) {
            $query['mail2'] = $request->mail2;
        }
        if ($request->amountFixed != null) {
            $query['amountFixed'] = $request->amountFixed;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Sandbox->value,
                    path: "PaymentLink/bill/lotNumber/{$lotNumber}",
                    method: HttpMethod::POST,
                    query: $query,
                    body: $request->body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Partially updates a Pay Out payment link's content, expiration date, and/or status. Use this to modify the payment page configuration, extend or change the expiration, or cancel a link. Updating the expiration date of an expired link reactivates it to Active status.
     *
     * Example:
     * ```php
     * $client->paymentLink->patchOutPaymentLink(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     new PatchOutPaymentLinkRequest([
     *         'expirationDate' => '2026-06-01T00:00:00Z',
     *         'status' => PaymentLinkStatus::Active->value,
     *     ]),
     * );
     * ```
     *
     * @param string $paylinkId ID for the payment link.
     * @param PatchOutPaymentLinkRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function patchOutPaymentLink(string $paylinkId, PatchOutPaymentLinkRequest $request = new PatchOutPaymentLinkRequest(), ?array $options = null): ?PayabliApiResponsePaymentLinks
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
                    path: "PaymentLink/out/{$paylinkId}",
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
     * Updates the payment page content for a Pay Out payment link. Use this to change the branding, messaging, payment methods offered, or other page configuration.
     *
     * Example:
     * ```php
     * $client->paymentLink->updatePayLinkOutFromId(
     *     '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
     *     new PaymentPageRequestBodyOut([
     *         'contactUs' => new ContactElement([
     *             'emailLabel' => 'Email',
     *             'enabled' => true,
     *             'header' => 'Contact Us',
     *             'order' => 0,
     *             'paymentIcons' => true,
     *             'phoneLabel' => 'Phone',
     *         ]),
     *         'logo' => new Element([
     *             'enabled' => true,
     *             'order' => 0,
     *         ]),
     *         'messageBeforePaying' => new LabelElement([
     *             'enabled' => true,
     *             'label' => 'Please review your payment details',
     *             'order' => 0,
     *         ]),
     *         'notes' => new NoteElement([
     *             'enabled' => true,
     *             'header' => 'Additional Notes',
     *             'order' => 0,
     *             'placeholder' => 'Enter any additional notes here',
     *             'value' => '',
     *         ]),
     *         'page' => new PageElement([
     *             'description' => 'Get paid securely',
     *             'enabled' => true,
     *             'header' => 'Payment Page',
     *             'order' => 0,
     *         ]),
     *         'paymentButton' => new LabelElement([
     *             'enabled' => true,
     *             'label' => 'Pay Now',
     *             'order' => 0,
     *         ]),
     *         'paymentMethods' => new MethodElementOut([
     *             'allMethodsChecked' => true,
     *             'allowMultipleMethods' => true,
     *             'defaultMethod' => 'vcard',
     *             'enabled' => true,
     *             'header' => 'Payment Methods',
     *             'methods' => new MethodsListOut([
     *                 'ach' => true,
     *                 'check' => true,
     *                 'vcard' => true,
     *             ]),
     *             'order' => 0,
     *             'showPreviewVirtualCard' => true,
     *         ]),
     *         'review' => new HeaderElement([
     *             'enabled' => true,
     *             'header' => 'Review Payment',
     *             'order' => 0,
     *         ]),
     *         'settings' => new PagelinkSetting([
     *             'color' => '#000000',
     *             'language' => 'en',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $paylinkId ID for the payment link.
     * @param PaymentPageRequestBodyOut $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PayabliApiResponsePaymentLinks
     * @throws PayabliException
     * @throws PayabliApiException
     */
    public function updatePayLinkOutFromId(string $paylinkId, PaymentPageRequestBodyOut $request, ?array $options = null): ?PayabliApiResponsePaymentLinks
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
                    path: "PaymentLink/updateOut/{$paylinkId}",
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
                return PayabliApiResponsePaymentLinks::fromJson($json);
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
