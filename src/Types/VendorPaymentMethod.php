<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Exception;
use Payabli\Core\Json\JsonDecoder;

/**
 * Object containing details about the payment method to use for the payout.
 */
class VendorPaymentMethod extends JsonSerializableType
{
    /**
     * @var (
     *    'managed'
     *   |'vcard'
     *   |'ach'
     *   |'check'
     *   |'_unknown'
     * ) $method
     */
    public readonly string $method;

    /**
     * @var (
     *    ManagedPaymentMethod
     *   |VCardPaymentMethod
     *   |AchPaymentMethod
     *   |CheckPaymentMethod
     *   |mixed
     * ) $value
     */
    public readonly mixed $value;

    /**
     * @param array{
     *   method: (
     *    'managed'
     *   |'vcard'
     *   |'ach'
     *   |'check'
     *   |'_unknown'
     * ),
     *   value: (
     *    ManagedPaymentMethod
     *   |VCardPaymentMethod
     *   |AchPaymentMethod
     *   |CheckPaymentMethod
     *   |mixed
     * ),
     * } $values
     */
    private function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->value = $values['value'];
    }

    /**
     * @param ManagedPaymentMethod $managed
     * @return VendorPaymentMethod
     */
    public static function managed(ManagedPaymentMethod $managed): VendorPaymentMethod
    {
        return new VendorPaymentMethod([
            'method' => 'managed',
            'value' => $managed,
        ]);
    }

    /**
     * @param VCardPaymentMethod $vcard
     * @return VendorPaymentMethod
     */
    public static function vcard(VCardPaymentMethod $vcard): VendorPaymentMethod
    {
        return new VendorPaymentMethod([
            'method' => 'vcard',
            'value' => $vcard,
        ]);
    }

    /**
     * @param AchPaymentMethod $ach
     * @return VendorPaymentMethod
     */
    public static function ach(AchPaymentMethod $ach): VendorPaymentMethod
    {
        return new VendorPaymentMethod([
            'method' => 'ach',
            'value' => $ach,
        ]);
    }

    /**
     * @param CheckPaymentMethod $check
     * @return VendorPaymentMethod
     */
    public static function check(CheckPaymentMethod $check): VendorPaymentMethod
    {
        return new VendorPaymentMethod([
            'method' => 'check',
            'value' => $check,
        ]);
    }

    /**
     * @return bool
     */
    public function isManaged(): bool
    {
        return $this->value instanceof ManagedPaymentMethod && $this->method === 'managed';
    }

    /**
     * @return ManagedPaymentMethod
     */
    public function asManaged(): ManagedPaymentMethod
    {
        if (!($this->value instanceof ManagedPaymentMethod && $this->method === 'managed')) {
            throw new Exception(
                "Expected managed; got " . $this->method . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isVcard(): bool
    {
        return $this->value instanceof VCardPaymentMethod && $this->method === 'vcard';
    }

    /**
     * @return VCardPaymentMethod
     */
    public function asVcard(): VCardPaymentMethod
    {
        if (!($this->value instanceof VCardPaymentMethod && $this->method === 'vcard')) {
            throw new Exception(
                "Expected vcard; got " . $this->method . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isAch(): bool
    {
        return $this->value instanceof AchPaymentMethod && $this->method === 'ach';
    }

    /**
     * @return AchPaymentMethod
     */
    public function asAch(): AchPaymentMethod
    {
        if (!($this->value instanceof AchPaymentMethod && $this->method === 'ach')) {
            throw new Exception(
                "Expected ach; got " . $this->method . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isCheck(): bool
    {
        return $this->value instanceof CheckPaymentMethod && $this->method === 'check';
    }

    /**
     * @return CheckPaymentMethod
     */
    public function asCheck(): CheckPaymentMethod
    {
        if (!($this->value instanceof CheckPaymentMethod && $this->method === 'check')) {
            throw new Exception(
                "Expected check; got " . $this->method . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        $result['method'] = $this->method;

        $base = parent::jsonSerialize();
        $result = array_merge($base, $result);

        switch ($this->method) {
            case 'managed':
                $value = $this->asManaged()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'vcard':
                $value = $this->asVcard()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'ach':
                $value = $this->asAch()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'check':
                $value = $this->asCheck()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case '_unknown':
            default:
                if (is_null($this->value)) {
                    break;
                }
                if ($this->value instanceof JsonSerializableType) {
                    $value = $this->value->jsonSerialize();
                    $result = array_merge($value, $result);
                } elseif (is_array($this->value)) {
                    $result = array_merge($this->value, $result);
                }
        }

        return $result;
    }

    /**
     * @param string $json
     */
    public static function fromJson(string $json): static
    {
        $decodedJson = JsonDecoder::decode($json);
        if (!is_array($decodedJson)) {
            throw new Exception("Unexpected non-array decoded type: " . gettype($decodedJson));
        }
        return self::jsonDeserialize($decodedJson);
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function jsonDeserialize(array $data): static
    {
        $args = [];
        if (!array_key_exists('method', $data)) {
            throw new Exception(
                "JSON data is missing property 'method'",
            );
        }
        $method = $data['method'];
        if (!(is_string($method))) {
            throw new Exception(
                "Expected property 'method' in JSON data to be string, instead received " . get_debug_type($data['method']),
            );
        }

        $args['method'] = $method;
        switch ($method) {
            case 'managed':
                $args['value'] = ManagedPaymentMethod::jsonDeserialize($data);
                break;
            case 'vcard':
                $args['value'] = VCardPaymentMethod::jsonDeserialize($data);
                break;
            case 'ach':
                $args['value'] = AchPaymentMethod::jsonDeserialize($data);
                break;
            case 'check':
                $args['value'] = CheckPaymentMethod::jsonDeserialize($data);
                break;
            case '_unknown':
            default:
                $args['method'] = '_unknown';
                $args['value'] = $data;
        }

        // @phpstan-ignore-next-line
        return new static($args);
    }
}
