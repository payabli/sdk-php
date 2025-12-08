<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Export\Types\ExportFormat1;
use Payabli\Export\Requests\ExportApplicationsRequest;
use Payabli\Export\Requests\ExportBatchDetailsRequest;
use Payabli\Export\Requests\ExportBatchDetailsOrgRequest;
use Payabli\Export\Requests\ExportBatchesRequest;
use Payabli\Export\Requests\ExportBatchesOrgRequest;
use Payabli\Export\Requests\ExportBatchesOutRequest;
use Payabli\Export\Requests\ExportBatchesOutOrgRequest;
use Payabli\Export\Requests\ExportBillsRequest;
use Payabli\Export\Requests\ExportBillsOrgRequest;
use Payabli\Export\Requests\ExportChargebacksRequest;
use Payabli\Export\Requests\ExportChargebacksOrgRequest;
use Payabli\Export\Requests\ExportCustomersRequest;
use Payabli\Export\Requests\ExportCustomersOrgRequest;
use Payabli\Export\Requests\ExportInvoicesRequest;
use Payabli\Export\Requests\ExportInvoicesOrgRequest;
use Payabli\Export\Requests\ExportOrganizationsRequest;
use Payabli\Export\Requests\ExportPayoutRequest;
use Payabli\Export\Requests\ExportPayoutOrgRequest;
use Payabli\Export\Requests\ExportPaypointsRequest;
use Payabli\Export\Requests\ExportSettlementsRequest;
use Payabli\Export\Requests\ExportSettlementsOrgRequest;
use Payabli\Export\Requests\ExportSubscriptionsRequest;
use Payabli\Export\Requests\ExportSubscriptionsOrgRequest;
use Payabli\Export\Requests\ExportTransactionsRequest;
use Payabli\Export\Requests\ExportTransactionsOrgRequest;
use Payabli\Export\Requests\ExportTransferDetailsRequest;
use Payabli\Export\Requests\ExportTransfersRequest;
use Payabli\Export\Requests\ExportVendorsRequest;
use Payabli\Export\Requests\ExportVendorsOrgRequest;

class ExportWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testExportApplications(): void {
        $testId = 'export.export_applications.0';
        $this->client->export->exportApplications(
            ExportFormat1::Csv->value,
            123,
            new ExportApplicationsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_applications.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/boarding/csv/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatchDetails(): void {
        $testId = 'export.export_batch_details.0';
        $this->client->export->exportBatchDetails(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportBatchDetailsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batch_details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batchDetails/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatchDetailsOrg(): void {
        $testId = 'export.export_batch_details_org.0';
        $this->client->export->exportBatchDetailsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportBatchDetailsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batch_details_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batchDetails/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatches(): void {
        $testId = 'export.export_batches.0';
        $this->client->export->exportBatches(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportBatchesRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batches.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batches/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatchesOrg(): void {
        $testId = 'export.export_batches_org.0';
        $this->client->export->exportBatchesOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportBatchesOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batches_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batches/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatchesOut(): void {
        $testId = 'export.export_batches_out.0';
        $this->client->export->exportBatchesOut(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportBatchesOutRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batches_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batchesOut/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBatchesOutOrg(): void {
        $testId = 'export.export_batches_out_org.0';
        $this->client->export->exportBatchesOutOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportBatchesOutOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_batches_out_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/batchesOut/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBills(): void {
        $testId = 'export.export_bills.0';
        $this->client->export->exportBills(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportBillsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_bills.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/bills/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportBillsOrg(): void {
        $testId = 'export.export_bills_org.0';
        $this->client->export->exportBillsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportBillsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_bills_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/bills/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportChargebacks(): void {
        $testId = 'export.export_chargebacks.0';
        $this->client->export->exportChargebacks(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportChargebacksRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_chargebacks.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/chargebacks/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportChargebacksOrg(): void {
        $testId = 'export.export_chargebacks_org.0';
        $this->client->export->exportChargebacksOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportChargebacksOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_chargebacks_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/chargebacks/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportCustomers(): void {
        $testId = 'export.export_customers.0';
        $this->client->export->exportCustomers(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportCustomersRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_customers.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/customers/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportCustomersOrg(): void {
        $testId = 'export.export_customers_org.0';
        $this->client->export->exportCustomersOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportCustomersOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_customers_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/customers/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportInvoices(): void {
        $testId = 'export.export_invoices.0';
        $this->client->export->exportInvoices(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportInvoicesRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_invoices.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/invoices/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportInvoicesOrg(): void {
        $testId = 'export.export_invoices_org.0';
        $this->client->export->exportInvoicesOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportInvoicesOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_invoices_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/invoices/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportOrganizations(): void {
        $testId = 'export.export_organizations.0';
        $this->client->export->exportOrganizations(
            ExportFormat1::Csv->value,
            123,
            new ExportOrganizationsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_organizations.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/organizations/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportPayout(): void {
        $testId = 'export.export_payout.0';
        $this->client->export->exportPayout(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportPayoutRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_payout.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/payouts/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportPayoutOrg(): void {
        $testId = 'export.export_payout_org.0';
        $this->client->export->exportPayoutOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportPayoutOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_payout_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/payouts/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportPaypoints(): void {
        $testId = 'export.export_paypoints.0';
        $this->client->export->exportPaypoints(
            ExportFormat1::Csv->value,
            123,
            new ExportPaypointsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_paypoints.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/paypoints/csv/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportSettlements(): void {
        $testId = 'export.export_settlements.0';
        $this->client->export->exportSettlements(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportSettlementsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_settlements.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/settlements/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportSettlementsOrg(): void {
        $testId = 'export.export_settlements_org.0';
        $this->client->export->exportSettlementsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportSettlementsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_settlements_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/settlements/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportSubscriptions(): void {
        $testId = 'export.export_subscriptions.0';
        $this->client->export->exportSubscriptions(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportSubscriptionsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_subscriptions.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/subscriptions/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportSubscriptionsOrg(): void {
        $testId = 'export.export_subscriptions_org.0';
        $this->client->export->exportSubscriptionsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportSubscriptionsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_subscriptions_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/subscriptions/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportTransactions(): void {
        $testId = 'export.export_transactions.0';
        $this->client->export->exportTransactions(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportTransactionsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_transactions.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/transactions/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportTransactionsOrg(): void {
        $testId = 'export.export_transactions_org.0';
        $this->client->export->exportTransactionsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportTransactionsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_transactions_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/transactions/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportTransferDetails(): void {
        $testId = 'export.export_transfer_details.0';
        $this->client->export->exportTransferDetails(
            '8cfec329267',
            ExportFormat1::Csv->value,
            1000000,
            new ExportTransferDetailsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_transfer_details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/transferDetails/csv/8cfec329267/1000000",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testExportTransfers(): void {
        $testId = 'export.export_transfers.0';
        $this->client->export->exportTransfers(
            '8cfec329267',
            new ExportTransfersRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_transfers.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/transfers/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testExportVendors(): void {
        $testId = 'export.export_vendors.0';
        $this->client->export->exportVendors(
            '8cfec329267',
            ExportFormat1::Csv->value,
            new ExportVendorsRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_vendors.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/vendors/csv/8cfec329267",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
            1
        );
    }

    /**
     */
    public function testExportVendorsOrg(): void {
        $testId = 'export.export_vendors_org.0';
        $this->client->export->exportVendorsOrg(
            ExportFormat1::Csv->value,
            123,
            new ExportVendorsOrgRequest([
                'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
                'fromRecord' => 251,
                'limitRecord' => 1000,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'export.export_vendors_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/vendors/csv/org/123",
            ['columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name', 'fromRecord' => '251', 'limitRecord' => '1000'],
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
