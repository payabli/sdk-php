<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Types\VendorData;
use Payabli\Types\Contacts;
use Payabli\Types\BillingData;
use Payabli\Types\TypeAccount;
use Payabli\Types\BankAccountHolderType;

class VendorWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddVendor(): void {
        $testId = 'vendor.add_vendor.0';
        $this->client->vendor->addVendor(
            '8cfec329267',
            new VendorData([
                'vendorNumber' => '1234',
                'name1' => "Herman's Coatings and Masonry",
                'name2' => '<string>',
                'ein' => '12-3456789',
                'phone' => '5555555555',
                'email' => 'example@email.com',
                'address1' => '123 Ocean Drive',
                'address2' => 'Suite 400',
                'city' => 'Miami',
                'state' => 'FL',
                'zip' => '33139',
                'country' => 'US',
                'mcc' => '7777',
                'locationCode' => 'MIA123',
                'contacts' => [
                    new Contacts([
                        'contactName' => 'Herman Martinez',
                        'contactEmail' => 'example@email.com',
                        'contactTitle' => 'Owner',
                        'contactPhone' => '3055550000',
                    ]),
                ],
                'billingData' => new BillingData([
                    'id' => 123,
                    'bankName' => 'Country Bank',
                    'routingAccount' => '123123123',
                    'accountNumber' => '123123123',
                    'typeAccount' => TypeAccount::Checking->value,
                    'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
                    'bankAccountHolderType' => BankAccountHolderType::Business->value,
                    'bankAccountFunction' => 0,
                ]),
                'paymentMethod' => 'managed',
                'vendorStatus' => 1,
                'remitAddress1' => '123 Walnut Street',
                'remitAddress2' => 'Suite 900',
                'remitCity' => 'Miami',
                'remitState' => 'FL',
                'remitZip' => '31113',
                'remitCountry' => 'US',
                'payeeName1' => '<string>',
                'payeeName2' => '<string>',
                'customerVendorAccount' => 'A-37622',
                'internalReferenceId' => 123,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'vendor.add_vendor.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Vendor/single/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteVendor(): void {
        $testId = 'vendor.delete_vendor.0';
        $this->client->vendor->deleteVendor(
            1,
            [
                'headers' => [
                    'X-Test-Id' => 'vendor.delete_vendor.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Vendor/1",
            null,
            1
        );
    }

    /**
     */
    public function testEditVendor(): void {
        $testId = 'vendor.edit_vendor.0';
        $this->client->vendor->editVendor(
            1,
            new VendorData([
                'name1' => "Theodore's Janitorial",
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'vendor.edit_vendor.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Vendor/1",
            null,
            1
        );
    }

    /**
     */
    public function testGetVendor(): void {
        $testId = 'vendor.get_vendor.0';
        $this->client->vendor->getVendor(
            1,
            [
                'headers' => [
                    'X-Test-Id' => 'vendor.get_vendor.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Vendor/1",
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
