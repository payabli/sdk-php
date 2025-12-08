<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Query\Requests\ListBatchDetailsRequest;
use Payabli\Query\Requests\ListBatchDetailsOrgRequest;
use Payabli\Query\Requests\ListBatchesRequest;
use Payabli\Query\Requests\ListBatchesOrgRequest;
use Payabli\Query\Requests\ListBatchesOutRequest;
use Payabli\Query\Requests\ListBatchesOutOrgRequest;
use Payabli\Query\Requests\ListChargebacksRequest;
use Payabli\Query\Requests\ListChargebacksOrgRequest;
use Payabli\Query\Requests\ListCustomersRequest;
use Payabli\Query\Requests\ListCustomersOrgRequest;
use Payabli\Query\Requests\ListNotificationReportsRequest;
use Payabli\Query\Requests\ListNotificationReportsOrgRequest;
use Payabli\Query\Requests\ListNotificationsRequest;
use Payabli\Query\Requests\ListNotificationsOrgRequest;
use Payabli\Query\Requests\ListOrganizationsRequest;
use Payabli\Query\Requests\ListPayoutRequest;
use Payabli\Query\Requests\ListPayoutOrgRequest;
use Payabli\Query\Requests\ListPaypointsRequest;
use Payabli\Query\Requests\ListSettlementsRequest;
use Payabli\Query\Requests\ListSettlementsOrgRequest;
use Payabli\Query\Requests\ListSubscriptionsRequest;
use Payabli\Query\Requests\ListSubscriptionsOrgRequest;
use Payabli\Query\Requests\ListTransactionsRequest;
use Payabli\Query\Requests\ListTransactionsOrgRequest;
use Payabli\Query\Requests\ListTransfersPaypointRequest;
use Payabli\Query\Requests\ListTransfersRequest;
use Payabli\Query\Requests\ListTransfersRequestOrg;
use Payabli\Query\Requests\ListUsersOrgRequest;
use Payabli\Query\Requests\ListUsersPaypointRequest;
use Payabli\Query\Requests\ListVendorsRequest;
use Payabli\Query\Requests\ListVendorsOrgRequest;
use Payabli\Query\Requests\ListVcardsRequest;
use Payabli\Query\Requests\ListVcardsOrgRequest;

class QueryWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testListBatchDetails(): void {
        $testId = 'query.list_batch_details.0';
        $this->client->query->listBatchDetails(
            '8cfec329267',
            new ListBatchDetailsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batch_details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batchDetails/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBatchDetailsOrg(): void {
        $testId = 'query.list_batch_details_org.0';
        $this->client->query->listBatchDetailsOrg(
            123,
            new ListBatchDetailsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batch_details_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batchDetails/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBatches(): void {
        $testId = 'query.list_batches.0';
        $this->client->query->listBatches(
            '8cfec329267',
            new ListBatchesRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batches.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batches/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBatchesOrg(): void {
        $testId = 'query.list_batches_org.0';
        $this->client->query->listBatchesOrg(
            123,
            new ListBatchesOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batches_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batches/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBatchesOut(): void {
        $testId = 'query.list_batches_out.0';
        $this->client->query->listBatchesOut(
            '8cfec329267',
            new ListBatchesOutRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batches_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batchesOut/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBatchesOutOrg(): void {
        $testId = 'query.list_batches_out_org.0';
        $this->client->query->listBatchesOutOrg(
            123,
            new ListBatchesOutOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_batches_out_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/batchesOut/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListChargebacks(): void {
        $testId = 'query.list_chargebacks.0';
        $this->client->query->listChargebacks(
            '8cfec329267',
            new ListChargebacksRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_chargebacks.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/chargebacks/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListChargebacksOrg(): void {
        $testId = 'query.list_chargebacks_org.0';
        $this->client->query->listChargebacksOrg(
            123,
            new ListChargebacksOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_chargebacks_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/chargebacks/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListCustomers(): void {
        $testId = 'query.list_customers.0';
        $this->client->query->listCustomers(
            '8cfec329267',
            new ListCustomersRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_customers.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/customers/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListCustomersOrg(): void {
        $testId = 'query.list_customers_org.0';
        $this->client->query->listCustomersOrg(
            123,
            new ListCustomersOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_customers_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/customers/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListNotificationReports(): void {
        $testId = 'query.list_notification_reports.0';
        $this->client->query->listNotificationReports(
            '8cfec329267',
            new ListNotificationReportsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_notification_reports.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/notificationReports/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListNotificationReportsOrg(): void {
        $testId = 'query.list_notification_reports_org.0';
        $this->client->query->listNotificationReportsOrg(
            123,
            new ListNotificationReportsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_notification_reports_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/notificationReports/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListNotifications(): void {
        $testId = 'query.list_notifications.0';
        $this->client->query->listNotifications(
            '8cfec329267',
            new ListNotificationsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_notifications.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/notifications/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListNotificationsOrg(): void {
        $testId = 'query.list_notifications_org.0';
        $this->client->query->listNotificationsOrg(
            123,
            new ListNotificationsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_notifications_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/notifications/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListOrganizations(): void {
        $testId = 'query.list_organizations.0';
        $this->client->query->listOrganizations(
            123,
            new ListOrganizationsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_organizations.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/organizations/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListPayout(): void {
        $testId = 'query.list_payout.0';
        $this->client->query->listPayout(
            '8cfec329267',
            new ListPayoutRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_payout.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/payouts/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListPayoutOrg(): void {
        $testId = 'query.list_payout_org.0';
        $this->client->query->listPayoutOrg(
            123,
            new ListPayoutOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_payout_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/payouts/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListPaypoints(): void {
        $testId = 'query.list_paypoints.0';
        $this->client->query->listPaypoints(
            123,
            new ListPaypointsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_paypoints.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/paypoints/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListSettlements(): void {
        $testId = 'query.list_settlements.0';
        $this->client->query->listSettlements(
            '8cfec329267',
            new ListSettlementsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_settlements.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/settlements/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListSettlementsOrg(): void {
        $testId = 'query.list_settlements_org.0';
        $this->client->query->listSettlementsOrg(
            123,
            new ListSettlementsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_settlements_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/settlements/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListSubscriptions(): void {
        $testId = 'query.list_subscriptions.0';
        $this->client->query->listSubscriptions(
            '8cfec329267',
            new ListSubscriptionsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_subscriptions.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/subscriptions/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListSubscriptionsOrg(): void {
        $testId = 'query.list_subscriptions_org.0';
        $this->client->query->listSubscriptionsOrg(
            123,
            new ListSubscriptionsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_subscriptions_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/subscriptions/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListTransactions(): void {
        $testId = 'query.list_transactions.0';
        $this->client->query->listTransactions(
            '8cfec329267',
            new ListTransactionsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_transactions.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/transactions/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListTransactionsOrg(): void {
        $testId = 'query.list_transactions_org.0';
        $this->client->query->listTransactionsOrg(
            123,
            new ListTransactionsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_transactions_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/transactions/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListTransferDetails(): void {
        $testId = 'query.list_transfer_details.0';
        $this->client->query->listTransferDetails(
            '47862acd',
            123456,
            new ListTransfersPaypointRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_transfer_details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/transferDetails/47862acd/123456",
            null,
            1
        );
    }

    /**
     */
    public function testListTransfers(): void {
        $testId = 'query.list_transfers.0';
        $this->client->query->listTransfers(
            '47862acd',
            new ListTransfersRequest([
                'fromRecord' => 0,
                'limitRecord' => 20,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_transfers.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/transfers/47862acd",
            ['fromRecord' => '0', 'limitRecord' => '20'],
            1
        );
    }

    /**
     */
    public function testListTransfersOrg(): void {
        $testId = 'query.list_transfers_org.0';
        $this->client->query->listTransfersOrg(
            123,
            new ListTransfersRequestOrg([
                'fromRecord' => 0,
                'limitRecord' => 20,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_transfers_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/transfers/org/123",
            ['fromRecord' => '0', 'limitRecord' => '20'],
            1
        );
    }

    /**
     */
    public function testListUsersOrg(): void {
        $testId = 'query.list_users_org.0';
        $this->client->query->listUsersOrg(
            123,
            new ListUsersOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_users_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/users/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListUsersPaypoint(): void {
        $testId = 'query.list_users_paypoint.0';
        $this->client->query->listUsersPaypoint(
            '8cfec329267',
            new ListUsersPaypointRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_users_paypoint.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/users/point/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListVendors(): void {
        $testId = 'query.list_vendors.0';
        $this->client->query->listVendors(
            '8cfec329267',
            new ListVendorsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_vendors.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/vendors/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListVendorsOrg(): void {
        $testId = 'query.list_vendors_org.0';
        $this->client->query->listVendorsOrg(
            123,
            new ListVendorsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_vendors_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/vendors/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListVcards(): void {
        $testId = 'query.list_vcards.0';
        $this->client->query->listVcards(
            '8cfec329267',
            new ListVcardsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_vcards.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/vcards/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListVcardsOrg(): void {
        $testId = 'query.list_vcards_org.0';
        $this->client->query->listVcardsOrg(
            123,
            new ListVcardsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'query.list_vcards_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/vcards/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
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
