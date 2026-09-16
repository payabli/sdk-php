<?php

namespace Payabli\Taptopay\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class TapToPayActivationChallengeRequest extends JsonSerializableType
{
    /**
     * @var string $entry
     */
    #[JsonProperty('entry')]
    public string $entry;

    /**
     * @var string $deviceId The device identifier (`poiId`) returned when the device was registered.
     */
    #[JsonProperty('deviceId')]
    public string $deviceId;

    /**
     * @param array{
     *   entry: string,
     *   deviceId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->entry = $values['entry'];
        $this->deviceId = $values['deviceId'];
    }
}
