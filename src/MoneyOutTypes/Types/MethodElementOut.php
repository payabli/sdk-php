<?php

namespace Payabli\MoneyOutTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Configuration for payment method selection on Pay Out payment links.
 */
class MethodElementOut extends JsonSerializableType
{
    /**
     * @var ?bool $allMethodsChecked Flag indicating if all allowed payment methods will be pre-selected.
     */
    #[JsonProperty('allMethodsChecked')]
    public ?bool $allMethodsChecked;

    /**
     * @var ?bool $allowMultipleMethods When `true`, the vendor can select from multiple payment methods. When `false`, only the default method is shown.
     */
    #[JsonProperty('allowMultipleMethods')]
    public ?bool $allowMultipleMethods;

    /**
     * @var ?string $defaultMethod The default payment method to highlight on the payment link page. For example, `"vcard"`, `"ach"`, or `"check"`.
     */
    #[JsonProperty('defaultMethod')]
    public ?string $defaultMethod;

    /**
     * @var ?bool $enabled When `true`, the payment methods section is displayed on the payment link page.
     */
    #[JsonProperty('enabled')]
    public ?bool $enabled;

    /**
     * @var ?string $header Header text for the payment methods section.
     */
    #[JsonProperty('header')]
    public ?string $header;

    /**
     * @var ?MethodsListOut $methods
     */
    #[JsonProperty('methods')]
    public ?MethodsListOut $methods;

    /**
     * @var ?int $order Display order of the payment methods section on the page.
     */
    #[JsonProperty('order')]
    public ?int $order;

    /**
     * @var ?bool $showPreviewVirtualCard When `true`, a preview of the virtual card is shown on the payment link page.
     */
    #[JsonProperty('showPreviewVirtualCard')]
    public ?bool $showPreviewVirtualCard;

    /**
     * @param array{
     *   allMethodsChecked?: ?bool,
     *   allowMultipleMethods?: ?bool,
     *   defaultMethod?: ?string,
     *   enabled?: ?bool,
     *   header?: ?string,
     *   methods?: ?MethodsListOut,
     *   order?: ?int,
     *   showPreviewVirtualCard?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->allMethodsChecked = $values['allMethodsChecked'] ?? null;
        $this->allowMultipleMethods = $values['allowMultipleMethods'] ?? null;
        $this->defaultMethod = $values['defaultMethod'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->header = $values['header'] ?? null;
        $this->methods = $values['methods'] ?? null;
        $this->order = $values['order'] ?? null;
        $this->showPreviewVirtualCard = $values['showPreviewVirtualCard'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
