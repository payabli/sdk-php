<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Types\UserData;
use Payabli\User\Requests\UserAuthResetRequest;
use Payabli\User\Requests\UserAuthRequest;
use Payabli\User\Requests\UserAuthPswResetRequest;
use Payabli\Types\MfaData;
use Payabli\User\Requests\GetUserRequest;
use Payabli\User\Requests\MfaValidationData;

class UserWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddUser(): void {
        $testId = 'user.add_user.0';
        $this->client->user->addUser(
            new UserData([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.add_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User",
            null,
            1
        );
    }

    /**
     */
    public function testAuthRefreshUser(): void {
        $testId = 'user.auth_refresh_user.0';
        $this->client->user->authRefreshUser(
            [
                'headers' => [
                    'X-Test-Id' => 'user.auth_refresh_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User/authrefresh",
            null,
            1
        );
    }

    /**
     */
    public function testAuthResetUser(): void {
        $testId = 'user.auth_reset_user.0';
        $this->client->user->authResetUser(
            new UserAuthResetRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.auth_reset_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User/authreset",
            null,
            1
        );
    }

    /**
     */
    public function testAuthUser(): void {
        $testId = 'user.auth_user.0';
        $this->client->user->authUser(
            'provider',
            new UserAuthRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.auth_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User/auth/provider",
            null,
            1
        );
    }

    /**
     */
    public function testChangePswUser(): void {
        $testId = 'user.change_psw_user.0';
        $this->client->user->changePswUser(
            new UserAuthPswResetRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.change_psw_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/User/authpsw",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteUser(): void {
        $testId = 'user.delete_user.0';
        $this->client->user->deleteUser(
            1000000,
            [
                'headers' => [
                    'X-Test-Id' => 'user.delete_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/User/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testEditMfaUser(): void {
        $testId = 'user.edit_mfa_user.0';
        $this->client->user->editMfaUser(
            1000000,
            new MfaData([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.edit_mfa_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/User/mfa/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testEditUser(): void {
        $testId = 'user.edit_user.0';
        $this->client->user->editUser(
            1000000,
            new UserData([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.edit_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/User/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testGetUser(): void {
        $testId = 'user.get_user.0';
        $this->client->user->getUser(
            1000000,
            new GetUserRequest([
                'entry' => '478ae1234',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.get_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/User/1000000",
            ['entry' => '478ae1234'],
            1
        );
    }

    /**
     */
    public function testLogoutUser(): void {
        $testId = 'user.logout_user.0';
        $this->client->user->logoutUser(
            [
                'headers' => [
                    'X-Test-Id' => 'user.logout_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/User/authlogout",
            null,
            1
        );
    }

    /**
     */
    public function testResendMfaCode(): void {
        $testId = 'user.resend_mfa_code.0';
        $this->client->user->resendMfaCode(
            'Entry',
            1,
            'usrname',
            [
                'headers' => [
                    'X-Test-Id' => 'user.resend_mfa_code.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User/resendmfa/usrname/Entry/1",
            null,
            1
        );
    }

    /**
     */
    public function testValidateMfaUser(): void {
        $testId = 'user.validate_mfa_user.0';
        $this->client->user->validateMfaUser(
            new MfaValidationData([]),
            [
                'headers' => [
                    'X-Test-Id' => 'user.validate_mfa_user.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/User/mfa",
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
