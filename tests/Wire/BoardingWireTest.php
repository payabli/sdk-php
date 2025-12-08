<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Types\ApplicationDataPayIn;
use Payabli\Types\ApplicationDataPayInServices;
use Payabli\Types\ApplicationDataPayInServicesAch;
use Payabli\Types\ApplicationDataPayInServicesCard;
use Payabli\Types\ApplicationDataPayInBankData;
use Payabli\Types\OwnType;
use Payabli\Types\ApplicationDataPayInContactsItem;
use Payabli\Types\ApplicationDataPayInOwnershipItem;
use Payabli\Types\SignerDataRequest;
use Payabli\Types\Whencharged;
use Payabli\Types\Whendelivered;
use Payabli\Types\Whenprovided;
use Payabli\Types\Whenrefunded;
use Payabli\Boarding\Requests\RequestAppByAuth;
use Payabli\Boarding\Requests\GetExternalApplicationRequest;
use Payabli\Boarding\Requests\ListApplicationsRequest;
use Payabli\Boarding\Requests\ListBoardingLinksRequest;
use Payabli\Types\ApplicationData;

class BoardingWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddApplication(): void {
        $testId = 'boarding.add_application.0';
        $this->client->boarding->addApplication(
            new ApplicationDataPayIn([
                'services' => new ApplicationDataPayInServices([
                    'ach' => new ApplicationDataPayInServicesAch([]),
                    'card' => new ApplicationDataPayInServicesCard([
                        'acceptAmex' => true,
                        'acceptDiscover' => true,
                        'acceptMastercard' => true,
                        'acceptVisa' => true,
                    ]),
                ]),
                'annualRevenue' => 1000,
                'averageBillSize' => '500',
                'averageMonthlyBill' => '5650',
                'avgmonthly' => 1000,
                'baddress' => '123 Walnut Street',
                'baddress1' => 'Suite 103',
                'bankData' => new ApplicationDataPayInBankData([]),
                'bcity' => 'New Vegas',
                'bcountry' => 'US',
                'binperson' => 60,
                'binphone' => 20,
                'binweb' => 20,
                'bstate' => 'FL',
                'bsummary' => 'Brick and mortar store that sells office supplies',
                'btype' => OwnType::LimitedLiabilityCompany->value,
                'bzip' => '33000',
                'contacts' => [
                    new ApplicationDataPayInContactsItem([
                        'contactEmail' => 'herman@hermanscoatings.com',
                        'contactName' => 'Herman Martinez',
                        'contactPhone' => '3055550000',
                        'contactTitle' => 'Owner',
                    ]),
                ],
                'creditLimit' => 'creditLimit',
                'dbaName' => 'Sunshine Gutters',
                'ein' => '123456789',
                'faxnumber' => '1234567890',
                'highticketamt' => 1000,
                'legalName' => 'Sunshine Services, LLC',
                'license' => '2222222FFG',
                'licstate' => 'CA',
                'maddress' => '123 Walnut Street',
                'maddress1' => 'STE 900',
                'mcc' => '7777',
                'mcity' => 'Johnson City',
                'mcountry' => 'US',
                'mstate' => 'TN',
                'mzip' => '37615',
                'orgId' => 123,
                'ownership' => [
                    new ApplicationDataPayInOwnershipItem([
                        'oaddress' => '33 North St',
                        'ocity' => 'Any City',
                        'ocountry' => 'US',
                        'odriverstate' => 'CA',
                        'ostate' => 'CA',
                        'ownerdob' => '01/01/1990',
                        'ownerdriver' => 'CA6677778',
                        'owneremail' => 'test@email.com',
                        'ownername' => 'John Smith',
                        'ownerpercent' => 100,
                        'ownerphone1' => '555888111',
                        'ownerphone2' => '555888111',
                        'ownerssn' => '123456789',
                        'ownertitle' => 'CEO',
                        'ozip' => '55555',
                    ]),
                ],
                'phonenumber' => '1234567890',
                'processingRegion' => 'US',
                'recipientEmail' => 'josephray@example.com',
                'recipientEmailNotification' => true,
                'resumable' => true,
                'signer' => new SignerDataRequest([
                    'address' => '33 North St',
                    'address1' => 'STE 900',
                    'city' => 'Bristol',
                    'country' => 'US',
                    'dob' => '01/01/1976',
                    'email' => 'test@email.com',
                    'name' => 'John Smith',
                    'phone' => '555888111',
                    'ssn' => '123456789',
                    'state' => 'TN',
                    'zip' => '55555',
                    'pciAttestation' => true,
                    'signedDocumentReference' => 'https://example.com/signed-document.pdf',
                    'attestationDate' => '04/20/2025',
                    'signDate' => '04/20/2025',
                    'additionalData' => '{"deviceId":"499585-389fj484-3jcj8hj3","session":"fifji4-fiu443-fn4843","timeWithCompany":"6 Years"}',
                ]),
                'startdate' => '01/01/1990',
                'taxFillName' => 'Sunshine LLC',
                'templateId' => 22,
                'ticketamt' => 1000,
                'website' => 'www.example.com',
                'whenCharged' => Whencharged::WhenServiceProvided->value,
                'whenDelivered' => Whendelivered::Over30Days->value,
                'whenProvided' => Whenprovided::ThirtyDaysOrLess->value,
                'whenRefunded' => Whenrefunded::ThirtyDaysOrLess->value,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.add_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Boarding/app",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteApplication(): void {
        $testId = 'boarding.delete_application.0';
        $this->client->boarding->deleteApplication(
            352,
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.delete_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Boarding/app/352",
            null,
            1
        );
    }

    /**
     */
    public function testGetApplication(): void {
        $testId = 'boarding.get_application.0';
        $this->client->boarding->getApplication(
            352,
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Boarding/read/352",
            null,
            1
        );
    }

    /**
     */
    public function testGetApplicationByAuth(): void {
        $testId = 'boarding.get_application_by_auth.0';
        $this->client->boarding->getApplicationByAuth(
            '17E',
            new RequestAppByAuth([
                'email' => 'admin@email.com',
                'referenceId' => 'n6UCd1f1ygG7',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_application_by_auth.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Boarding/read/17E",
            null,
            1
        );
    }

    /**
     */
    public function testGetByIdLinkApplication(): void {
        $testId = 'boarding.get_by_id_link_application.0';
        $this->client->boarding->getByIdLinkApplication(
            91,
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_by_id_link_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Boarding/linkbyId/91",
            null,
            1
        );
    }

    /**
     */
    public function testGetByTemplateIdLinkApplication(): void {
        $testId = 'boarding.get_by_template_id_link_application.0';
        $this->client->boarding->getByTemplateIdLinkApplication(
            80,
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_by_template_id_link_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Boarding/linkbyTemplate/80",
            null,
            1
        );
    }

    /**
     */
    public function testGetExternalApplication(): void {
        $testId = 'boarding.get_external_application.0';
        $this->client->boarding->getExternalApplication(
            352,
            'mail2',
            new GetExternalApplicationRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_external_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Boarding/applink/352/mail2",
            null,
            1
        );
    }

    /**
     */
    public function testGetLinkApplication(): void {
        $testId = 'boarding.get_link_application.0';
        $this->client->boarding->getLinkApplication(
            'myorgaccountname-00091',
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.get_link_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Boarding/link/myorgaccountname-00091",
            null,
            1
        );
    }

    /**
     */
    public function testListApplications(): void {
        $testId = 'boarding.list_applications.0';
        $this->client->boarding->listApplications(
            123,
            new ListApplicationsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.list_applications.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/boarding/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBoardingLinks(): void {
        $testId = 'boarding.list_boarding_links.0';
        $this->client->boarding->listBoardingLinks(
            123,
            new ListBoardingLinksRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.list_boarding_links.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/boardinglinks/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testUpdateApplication(): void {
        $testId = 'boarding.update_application.0';
        $this->client->boarding->updateApplication(
            352,
            new ApplicationData([]),
            [
                'headers' => [
                    'X-Test-Id' => 'boarding.update_application.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Boarding/app/352",
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
