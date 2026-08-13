<?php

namespace Payabli\Billing\Types;

enum GetProfileBillingRequestEntityType: string
{
    case Organization = "Organization";
    case Paypoint = "Paypoint";
    case Template = "Template";
    case Application = "Application";
}
