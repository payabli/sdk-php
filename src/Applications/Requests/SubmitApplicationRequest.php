<?php

namespace Payabli\Applications\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\SubmitSigner;
use Payabli\Core\Json\JsonProperty;

class SubmitApplicationRequest extends JsonSerializableType
{
    /**
     * @var SubmitSigner $signer The signature details for the application's signer, and optionally which person signs.
     */
    #[JsonProperty('signer')]
    public SubmitSigner $signer;

    /**
     * @param array{
     *   signer: SubmitSigner,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->signer = $values['signer'];
    }
}
