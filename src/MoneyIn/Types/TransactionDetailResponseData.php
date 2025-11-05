<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response data from payment processor
 */
class TransactionDetailResponseData extends JsonSerializableType
{
    /**
     * @var ?string $response
     */
    #[JsonProperty('response')]
    public ?string $response;

    /**
     * @var string $responsetext
     */
    #[JsonProperty('responsetext')]
    public string $responsetext;

    /**
     * @var ?string $authcode
     */
    #[JsonProperty('authcode')]
    public ?string $authcode;

    /**
     * @var string $transactionid
     */
    #[JsonProperty('transactionid')]
    public string $transactionid;

    /**
     * @var ?string $avsresponse
     */
    #[JsonProperty('avsresponse')]
    public ?string $avsresponse;

    /**
     * @var ?string $avsresponseText
     */
    #[JsonProperty('avsresponse_text')]
    public ?string $avsresponseText;

    /**
     * @var ?string $cvvresponse
     */
    #[JsonProperty('cvvresponse')]
    public ?string $cvvresponse;

    /**
     * @var ?string $cvvresponseText
     */
    #[JsonProperty('cvvresponse_text')]
    public ?string $cvvresponseText;

    /**
     * @var ?string $orderid
     */
    #[JsonProperty('orderid')]
    public ?string $orderid;

    /**
     * @var ?string $type
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var string $responseCode
     */
    #[JsonProperty('response_code')]
    public string $responseCode;

    /**
     * @var string $responseCodeText
     */
    #[JsonProperty('response_code_text')]
    public string $responseCodeText;

    /**
     * @var ?string $customerVaultId
     */
    #[JsonProperty('customer_vault_id')]
    public ?string $customerVaultId;

    /**
     * @var ?string $emvAuthResponseData
     */
    #[JsonProperty('emv_auth_response_data')]
    public ?string $emvAuthResponseData;

    /**
     * @param array{
     *   responsetext: string,
     *   transactionid: string,
     *   responseCode: string,
     *   responseCodeText: string,
     *   response?: ?string,
     *   authcode?: ?string,
     *   avsresponse?: ?string,
     *   avsresponseText?: ?string,
     *   cvvresponse?: ?string,
     *   cvvresponseText?: ?string,
     *   orderid?: ?string,
     *   type?: ?string,
     *   customerVaultId?: ?string,
     *   emvAuthResponseData?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->response = $values['response'] ?? null;
        $this->responsetext = $values['responsetext'];
        $this->authcode = $values['authcode'] ?? null;
        $this->transactionid = $values['transactionid'];
        $this->avsresponse = $values['avsresponse'] ?? null;
        $this->avsresponseText = $values['avsresponseText'] ?? null;
        $this->cvvresponse = $values['cvvresponse'] ?? null;
        $this->cvvresponseText = $values['cvvresponseText'] ?? null;
        $this->orderid = $values['orderid'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->responseCode = $values['responseCode'];
        $this->responseCodeText = $values['responseCodeText'];
        $this->customerVaultId = $values['customerVaultId'] ?? null;
        $this->emvAuthResponseData = $values['emvAuthResponseData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
