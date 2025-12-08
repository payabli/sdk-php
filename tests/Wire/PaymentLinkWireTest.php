<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\PaymentLink\Requests\PayLinkDataInvoice;
use Payabli\PaymentLink\Types\PaymentPageRequestBody;
use Payabli\Types\ContactElement;
use Payabli\Types\InvoiceElement;
use Payabli\Types\LabelElement;
use Payabli\Types\Element;
use Payabli\Types\NoteElement;
use Payabli\Types\PageElement;
use Payabli\Types\MethodElement;
use Payabli\Types\MethodsList;
use Payabli\Types\MethodElementSettings;
use Payabli\Types\MethodElementSettingsApplePay;
use Payabli\Types\MethodElementSettingsApplePayButtonStyle;
use Payabli\Types\MethodElementSettingsApplePayButtonType;
use Payabli\Types\MethodElementSettingsApplePayLanguage;
use Payabli\Types\PayorElement;
use Payabli\Types\PayorFields;
use Payabli\Types\HeaderElement;
use Payabli\Types\PagelinkSetting;
use Payabli\Types\FileContent;
use Payabli\Types\FileContentFtype;
use Payabli\PaymentLink\Requests\PayLinkDataBill;
use Payabli\Types\PushPayLinkRequest;
use Payabli\Types\PushPayLinkRequestSms;
use Payabli\PaymentLink\Requests\RefreshPayLinkFromIdRequest;
use Payabli\PaymentLink\Requests\SendPayLinkFromIdRequest;
use Payabli\PaymentLink\Requests\PayLinkUpdateData;
use Payabli\PaymentLink\Requests\PayLinkDataOut;

class PaymentLinkWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddPayLinkFromInvoice(): void {
        $testId = 'payment_link.add_pay_link_from_invoice.0';
        $this->client->paymentLink->addPayLinkFromInvoice(
            23548884,
            new PayLinkDataInvoice([
                'mail2' => 'jo@example.com; ceo@example.com',
                'body' => new PaymentPageRequestBody([
                    'contactUs' => new ContactElement([
                        'emailLabel' => 'Email',
                        'enabled' => true,
                        'header' => 'Contact Us',
                        'order' => 0,
                        'paymentIcons' => true,
                        'phoneLabel' => 'Phone',
                    ]),
                    'invoices' => new InvoiceElement([
                        'enabled' => true,
                        'invoiceLink' => new LabelElement([
                            'enabled' => true,
                            'label' => 'View Invoice',
                            'order' => 0,
                        ]),
                        'order' => 0,
                        'viewInvoiceDetails' => new LabelElement([
                            'enabled' => true,
                            'label' => 'Invoice Details',
                            'order' => 0,
                        ]),
                    ]),
                    'logo' => new Element([
                        'enabled' => true,
                        'order' => 0,
                    ]),
                    'messageBeforePaying' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Please review your payment details',
                        'order' => 0,
                    ]),
                    'notes' => new NoteElement([
                        'enabled' => true,
                        'header' => 'Additional Notes',
                        'order' => 0,
                        'placeholder' => 'Enter any additional notes here',
                        'value' => '',
                    ]),
                    'page' => new PageElement([
                        'description' => 'Complete your payment securely',
                        'enabled' => true,
                        'header' => 'Payment Page',
                        'order' => 0,
                    ]),
                    'paymentButton' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Pay Now',
                        'order' => 0,
                    ]),
                    'paymentMethods' => new MethodElement([
                        'allMethodsChecked' => true,
                        'enabled' => true,
                        'header' => 'Payment Methods',
                        'methods' => new MethodsList([
                            'amex' => true,
                            'applePay' => true,
                            'discover' => true,
                            'eCheck' => true,
                            'mastercard' => true,
                            'visa' => true,
                        ]),
                        'order' => 0,
                        'settings' => new MethodElementSettings([
                            'applePay' => new MethodElementSettingsApplePay([
                                'buttonStyle' => MethodElementSettingsApplePayButtonStyle::Black->value,
                                'buttonType' => MethodElementSettingsApplePayButtonType::Pay->value,
                                'language' => MethodElementSettingsApplePayLanguage::EnUs->value,
                            ]),
                        ]),
                    ]),
                    'payor' => new PayorElement([
                        'enabled' => true,
                        'fields' => [
                            new PayorFields([
                                'display' => true,
                                'fixed' => true,
                                'identifier' => true,
                                'label' => 'Full Name',
                                'name' => 'fullName',
                                'order' => 0,
                                'required' => true,
                                'validation' => '^[a-zA-Z ]+$',
                                'value' => '',
                                'width' => 0,
                            ]),
                        ],
                        'header' => 'Payor Information',
                        'order' => 0,
                    ]),
                    'review' => new HeaderElement([
                        'enabled' => true,
                        'header' => 'Review Payment',
                        'order' => 0,
                    ]),
                    'settings' => new PagelinkSetting([
                        'color' => '#000000',
                        'customCssUrl' => 'https://example.com/custom.css',
                        'language' => 'en',
                        'pageLogo' => new FileContent([
                            'fContent' => 'PHN2ZyB2aWV3Qm94PSIwIDAgODAwIDEwMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPCEtLSBCYWNrZ3JvdW5kIC0tPgogIDxyZWN0IHdpZHRoPSI4MDAiIGhlaWdodD0iMTAwMCIgZmlsbD0id2hpdGUiLz4KICAKICA8IS0tIENvbXBhbnkgSGVhZGVyIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+R3J1enlhIEFkdmVudHVyZSBPdXRmaXR0ZXJzPC90ZXh0PgogIDxsaW5lIHgxPSI0MCIgeTE9IjgwIiB4Mj0iNzYwIiB5Mj0iODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIyIi8+CiAgCiAgPCEtLSBDb21wYW55IERldGFpbHMgLS0+CiAgPHRleHQgeD0iNDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xMjMgTW91bnRhaW4gVmlldyBSb2FkPC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxMzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGJpbGlzaSwgR2VvcmdpYSAwMTA1PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGVsOiArOTk1IDMyIDEyMyA0NTY3PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+RW1haWw6IGluZm9AZ3J1enlhYWR2ZW50dXJlcy5jb208L3RleHQ+CgogIDwhLS0gSW52b2ljZSBUaXRsZSAtLT4KICA8dGV4dCB4PSI2MDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+SU5WT0lDRTwvdGV4dD4KICA8dGV4dCB4PSI2MDAiIHk9IjE0MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5EYXRlOiAxMi8xMS8yMDI0PC90ZXh0PgogIDx0ZXh0IHg9IjYwMCIgeT0iMTYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkludm9pY2UgIzogR1JaLTIwMjQtMTEyMzwvdGV4dD4KCiAgPCEtLSBCaWxsIFRvIFNlY3Rpb24gLS0+CiAgPHRleHQgeD0iNDAiIHk9IjIyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+QklMTCBUTzo8L3RleHQ+CiAgPHJlY3QgeD0iNDAiIHk9IjIzNSIgd2lkdGg9IjMwMCIgaGVpZ2h0PSI4MCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSIyNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0N1c3RvbWVyIE5hbWVdPC90ZXh0PgogIDx0ZXh0IHg9IjUwIiB5PSIyODAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0FkZHJlc3MgTGluZSAxXTwvdGV4dD4KICA8dGV4dCB4PSI1MCIgeT0iMzAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPltDaXR5LCBDb3VudHJ5XTwvdGV4dD4KCiAgPCEtLSBUYWJsZSBIZWFkZXJzIC0tPgogIDxyZWN0IHg9IjQwIiB5PSIzNDAiIHdpZHRoPSI3MjAiIGhlaWdodD0iMzAiIGZpbGw9IiMyYzNlNTAiLz4KICA8dGV4dCB4PSI1MCIgeT0iMzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSJ3aGl0ZSI+RGVzY3JpcHRpb248L3RleHQ+CiAgPHRleHQgeD0iNDUwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5RdWFudGl0eTwvdGV4dD4KICA8dGV4dCB4PSI1NTAiIHk9IjM2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPlJhdGU8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5BbW91bnQ8L3RleHQ+CgogIDwhLS0gVGFibGUgUm93cyAtLT4KICA8cmVjdCB4PSI0MCIgeT0iMzcwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZjdmOWZhIi8+CiAgPHRleHQgeD0iNTAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5Nb3VudGFpbiBDbGltYmluZyBFcXVpcG1lbnQgUmVudGFsPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iMzkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSIzOTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDI1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMjUwLjAwPC90ZXh0PgoKICA8cmVjdCB4PSI0MCIgeT0iNDAwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSJ3aGl0ZSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+R3VpZGVkIFRyZWsgUGFja2FnZSAtIDIgRGF5czwvdGV4dD4KICA8dGV4dCB4PSI0NTAiIHk9IjQyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNDIwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQ0MDAuMDA8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDQwMC4wMDwvdGV4dD4KCiAgPHJlY3QgeD0iNDAiIHk9IjQzMCIgd2lkdGg9IjcyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U2FmZXR5IEVxdWlwbWVudCBQYWNrYWdlPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iNDUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDE1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjQ1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMTUwLjAwPC90ZXh0PgoKICA8IS0tIFRvdGFscyAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI0ODAiIHgyPSI3NjAiIHkyPSI0ODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNTUwIiB5PSI1MTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMzNDQ5NWUiPlN1YnRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjUxMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kODAwLjAwPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSIjMzQ0OTVlIj5UYXggKDE4JSk6PC90ZXh0PgogIDx0ZXh0IHg9IjY4MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQxNDQuMDA8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI1NzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjU3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+JDk0NC4wMDwvdGV4dD4KCiAgPCEtLSBQYXltZW50IFRlcm1zIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2NDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlBheW1lbnQgVGVybXM8L3RleHQ+CiAgPHRleHQgeD0iNDAiIHk9IjY3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5QYXltZW50IGlzIGR1ZSB3aXRoaW4gMzAgZGF5czwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNjkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPlBsZWFzZSBpbmNsdWRlIGludm9pY2UgbnVtYmVyIG9uIHBheW1lbnQ8L3RleHQ+CgogIDwhLS0gQmFuayBEZXRhaWxzIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI3MzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPkJhbmsgRGV0YWlsczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkJhbms6IEJhbmsgb2YgR2VvcmdpYTwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPklCQU46IEdFMTIzNDU2Nzg5MDEyMzQ1Njc4PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSI4MDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U1dJRlQ6IEJBR0FHRTIyPC90ZXh0PgoKICA8IS0tIEZvb3RlciAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI5MDAiIHgyPSI3NjAiIHkyPSI5MDAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNDAiIHk9IjkzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjN2Y4YzhkIj5UaGFuayB5b3UgZm9yIGNob29zaW5nIEdydXp5YSBBZHZlbnR1cmUgT3V0Zml0dGVyczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iOTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM3ZjhjOGQiPnd3dy5ncnV6eWFhZHZlbnR1cmVzLmNvbTwvdGV4dD4KPC9zdmc+Cg==',
                            'filename' => 'logo.jpg',
                            'ftype' => FileContentFtype::Jpg->value,
                            'furl' => '',
                        ]),
                        'redirectAfterApprove' => true,
                        'redirectAfterApproveUrl' => 'https://example.com/success',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.add_pay_link_from_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentLink/23548884",
            ['mail2' => 'jo@example.com; ceo@example.com'],
            1
        );
    }

    /**
     */
    public function testAddPayLinkFromBill(): void {
        $testId = 'payment_link.add_pay_link_from_bill.0';
        $this->client->paymentLink->addPayLinkFromBill(
            23548884,
            new PayLinkDataBill([
                'mail2' => 'jo@example.com; ceo@example.com',
                'body' => new PaymentPageRequestBody([
                    'contactUs' => new ContactElement([
                        'emailLabel' => 'Email',
                        'enabled' => true,
                        'header' => 'Contact Us',
                        'order' => 0,
                        'paymentIcons' => true,
                        'phoneLabel' => 'Phone',
                    ]),
                    'logo' => new Element([
                        'enabled' => true,
                        'order' => 0,
                    ]),
                    'messageBeforePaying' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Please review your payment details',
                        'order' => 0,
                    ]),
                    'notes' => new NoteElement([
                        'enabled' => true,
                        'header' => 'Additional Notes',
                        'order' => 0,
                        'placeholder' => 'Enter any additional notes here',
                        'value' => '',
                    ]),
                    'page' => new PageElement([
                        'description' => 'Get paid securely',
                        'enabled' => true,
                        'header' => 'Payment Page',
                        'order' => 0,
                    ]),
                    'paymentButton' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Pay Now',
                        'order' => 0,
                    ]),
                    'paymentMethods' => new MethodElement([
                        'allMethodsChecked' => true,
                        'enabled' => true,
                        'header' => 'Payment Methods',
                        'methods' => new MethodsList([
                            'amex' => true,
                            'applePay' => true,
                            'discover' => true,
                            'eCheck' => true,
                            'mastercard' => true,
                            'visa' => true,
                        ]),
                        'order' => 0,
                    ]),
                    'payor' => new PayorElement([
                        'enabled' => true,
                        'fields' => [
                            new PayorFields([
                                'display' => true,
                                'fixed' => true,
                                'identifier' => true,
                                'label' => 'Full Name',
                                'name' => 'fullName',
                                'order' => 0,
                                'required' => true,
                                'validation' => '^[a-zA-Z ]+$',
                                'value' => '',
                                'width' => 0,
                            ]),
                        ],
                        'header' => 'Payor Information',
                        'order' => 0,
                    ]),
                    'review' => new HeaderElement([
                        'enabled' => true,
                        'header' => 'Review Payment',
                        'order' => 0,
                    ]),
                    'settings' => new PagelinkSetting([
                        'color' => '#000000',
                        'language' => 'en',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.add_pay_link_from_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentLink/bill/23548884",
            ['mail2' => 'jo@example.com; ceo@example.com'],
            1
        );
    }

    /**
     */
    public function testDeletePayLinkFromId(): void {
        $testId = 'payment_link.delete_pay_link_from_id.0';
        $this->client->paymentLink->deletePayLinkFromId(
            'payLinkId',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.delete_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/PaymentLink/payLinkId",
            null,
            1
        );
    }

    /**
     */
    public function testGetPayLinkFromId(): void {
        $testId = 'payment_link.get_pay_link_from_id.0';
        $this->client->paymentLink->getPayLinkFromId(
            'paylinkId',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.get_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/PaymentLink/load/paylinkId",
            null,
            1
        );
    }

    /**
     */
    public function testPushPayLinkFromId(): void {
        $testId = 'payment_link.push_pay_link_from_id.0';
        $this->client->paymentLink->pushPayLinkFromId(
            'payLinkId',
            PushPayLinkRequest::sms(new PushPayLinkRequestSms([])),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.push_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentLink/push/payLinkId",
            null,
            1
        );
    }

    /**
     */
    public function testRefreshPayLinkFromId(): void {
        $testId = 'payment_link.refresh_pay_link_from_id.0';
        $this->client->paymentLink->refreshPayLinkFromId(
            'payLinkId',
            new RefreshPayLinkFromIdRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.refresh_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/PaymentLink/refresh/payLinkId",
            null,
            1
        );
    }

    /**
     */
    public function testSendPayLinkFromId(): void {
        $testId = 'payment_link.send_pay_link_from_id.0';
        $this->client->paymentLink->sendPayLinkFromId(
            'payLinkId',
            new SendPayLinkFromIdRequest([
                'mail2' => 'jo@example.com; ceo@example.com',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.send_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/PaymentLink/send/payLinkId",
            ['mail2' => 'jo@example.com; ceo@example.com'],
            1
        );
    }

    /**
     */
    public function testUpdatePayLinkFromId(): void {
        $testId = 'payment_link.update_pay_link_from_id.0';
        $this->client->paymentLink->updatePayLinkFromId(
            '332-c277b704-1301',
            new PayLinkUpdateData([
                'notes' => new NoteElement([
                    'enabled' => true,
                    'header' => 'Additional Notes',
                    'order' => 0,
                    'placeholder' => 'Enter any additional notes here',
                    'value' => '',
                ]),
                'paymentButton' => new LabelElement([
                    'enabled' => true,
                    'label' => 'Pay Now',
                    'order' => 0,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.update_pay_link_from_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/PaymentLink/update/332-c277b704-1301",
            null,
            1
        );
    }

    /**
     */
    public function testAddPayLinkFromBillLotNumber(): void {
        $testId = 'payment_link.add_pay_link_from_bill_lot_number.0';
        $this->client->paymentLink->addPayLinkFromBillLotNumber(
            'LOT-2024-001',
            new PayLinkDataOut([
                'entryPoint' => 'billing',
                'vendorNumber' => 'VENDOR-123',
                'mail2' => 'customer@example.com; billing@example.com',
                'amountFixed' => 'true',
                'body' => new PaymentPageRequestBody([
                    'contactUs' => new ContactElement([
                        'emailLabel' => 'Email',
                        'enabled' => true,
                        'header' => 'Contact Us',
                        'order' => 0,
                        'paymentIcons' => true,
                        'phoneLabel' => 'Phone',
                    ]),
                    'logo' => new Element([
                        'enabled' => true,
                        'order' => 0,
                    ]),
                    'messageBeforePaying' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Please review your payment details',
                        'order' => 0,
                    ]),
                    'notes' => new NoteElement([
                        'enabled' => true,
                        'header' => 'Additional Notes',
                        'order' => 0,
                        'placeholder' => 'Enter any additional notes here',
                        'value' => '',
                    ]),
                    'page' => new PageElement([
                        'description' => 'Get paid securely',
                        'enabled' => true,
                        'header' => 'Payment Page',
                        'order' => 0,
                    ]),
                    'paymentButton' => new LabelElement([
                        'enabled' => true,
                        'label' => 'Pay Now',
                        'order' => 0,
                    ]),
                    'paymentMethods' => new MethodElement([
                        'allMethodsChecked' => true,
                        'enabled' => true,
                        'header' => 'Payment Methods',
                        'methods' => new MethodsList([
                            'amex' => true,
                            'applePay' => true,
                            'discover' => true,
                            'eCheck' => true,
                            'mastercard' => true,
                            'visa' => true,
                        ]),
                        'order' => 0,
                    ]),
                    'payor' => new PayorElement([
                        'enabled' => true,
                        'fields' => [
                            new PayorFields([
                                'display' => true,
                                'fixed' => true,
                                'identifier' => true,
                                'label' => 'Full Name',
                                'name' => 'fullName',
                                'order' => 0,
                                'required' => true,
                                'validation' => '^[a-zA-Z ]+$',
                                'value' => '',
                                'width' => 0,
                            ]),
                        ],
                        'header' => 'Payor Information',
                        'order' => 0,
                    ]),
                    'review' => new HeaderElement([
                        'enabled' => true,
                        'header' => 'Review Payment',
                        'order' => 0,
                    ]),
                    'settings' => new PagelinkSetting([
                        'color' => '#000000',
                        'language' => 'en',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_link.add_pay_link_from_bill_lot_number.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentLink/bill/lotNumber/LOT-2024-001",
            ['entryPoint' => 'billing', 'vendorNumber' => 'VENDOR-123', 'mail2' => 'customer@example.com; billing@example.com', 'amountFixed' => 'true'],
            1
        );
    }

    /**
     */
    protected function setUp(): void {
        parent::setUp();
        $this->client = new PayabliClient(
            apiKey: 'test-apiKey',
        options: [
            'baseUrl' => 'http://localhost:8080',
        ],
        );
    }
}
