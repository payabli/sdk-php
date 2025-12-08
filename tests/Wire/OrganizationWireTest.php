<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Organization\Requests\AddOrganizationRequest;
use Payabli\Types\Instrument;
use Payabli\Types\Contacts;
use Payabli\Types\FileContent;
use Payabli\Types\FileContentFtype;
use Payabli\Organization\Requests\OrganizationData;

class OrganizationWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddOrganization(): void {
        $testId = 'organization.add_organization.0';
        $this->client->organization->addOrganization(
            new AddOrganizationRequest([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
                'billingInfo' => new Instrument([
                    'achAccount' => '123123123',
                    'achRouting' => '123123123',
                    'billingAddress' => '123 Walnut Street',
                    'billingCity' => 'Johnson City',
                    'billingCountry' => 'US',
                    'billingState' => 'TN',
                    'billingZip' => '37615',
                ]),
                'contacts' => [
                    new Contacts([
                        'contactEmail' => 'herman@hermanscoatings.com',
                        'contactName' => 'Herman Martinez',
                        'contactPhone' => '3055550000',
                        'contactTitle' => 'Owner',
                    ]),
                ],
                'hasBilling' => true,
                'hasResidual' => true,
                'orgAddress' => '123 Walnut Street',
                'orgCity' => 'Johnson City',
                'orgCountry' => 'US',
                'orgEntryName' => 'pilgrim-planner',
                'orgId' => '123',
                'orgLogo' => new FileContent([
                    'fContent' => 'TXkgdGVzdCBmaWxlHJ==...',
                    'filename' => 'my-doc.pdf',
                    'ftype' => FileContentFtype::Pdf->value,
                    'furl' => 'https://mysite.com/my-doc.pdf',
                ]),
                'orgName' => 'Pilgrim Planner',
                'orgParentId' => 236,
                'orgState' => 'TN',
                'orgTimezone' => -5,
                'orgType' => 0,
                'orgWebsite' => 'www.pilgrimageplanner.com',
                'orgZip' => '37615',
                'replyToEmail' => 'email@example.com',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'organization.add_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Organization",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteOrganization(): void {
        $testId = 'organization.delete_organization.0';
        $this->client->organization->deleteOrganization(
            123,
            [
                'headers' => [
                    'X-Test-Id' => 'organization.delete_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Organization/123",
            null,
            1
        );
    }

    /**
     */
    public function testEditOrganization(): void {
        $testId = 'organization.edit_organization.0';
        $this->client->organization->editOrganization(
            123,
            new OrganizationData([
                'contacts' => [
                    new Contacts([
                        'contactEmail' => 'herman@hermanscoatings.com',
                        'contactName' => 'Herman Martinez',
                        'contactPhone' => '3055550000',
                        'contactTitle' => 'Owner',
                    ]),
                ],
                'orgAddress' => '123 Walnut Street',
                'orgCity' => 'Johnson City',
                'orgCountry' => 'US',
                'orgEntryName' => 'pilgrim-planner',
                'organizationDataOrgId' => '123',
                'orgName' => 'Pilgrim Planner',
                'orgState' => 'TN',
                'orgTimezone' => -5,
                'orgType' => 0,
                'orgWebsite' => 'www.pilgrimageplanner.com',
                'orgZip' => '37615',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'organization.edit_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Organization/123",
            null,
            1
        );
    }

    /**
     */
    public function testGetBasicOrganization(): void {
        $testId = 'organization.get_basic_organization.0';
        $this->client->organization->getBasicOrganization(
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'organization.get_basic_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Organization/basic/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testGetBasicOrganizationById(): void {
        $testId = 'organization.get_basic_organization_by_id.0';
        $this->client->organization->getBasicOrganizationById(
            123,
            [
                'headers' => [
                    'X-Test-Id' => 'organization.get_basic_organization_by_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Organization/basicById/123",
            null,
            1
        );
    }

    /**
     */
    public function testGetOrganization(): void {
        $testId = 'organization.get_organization.0';
        $this->client->organization->getOrganization(
            123,
            [
                'headers' => [
                    'X-Test-Id' => 'organization.get_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Organization/read/123",
            null,
            1
        );
    }

    /**
     */
    public function testGetSettingsOrganization(): void {
        $testId = 'organization.get_settings_organization.0';
        $this->client->organization->getSettingsOrganization(
            123,
            [
                'headers' => [
                    'X-Test-Id' => 'organization.get_settings_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Organization/settings/123",
            null,
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
