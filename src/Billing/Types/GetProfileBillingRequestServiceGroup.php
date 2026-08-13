<?php

namespace Payabli\Billing\Types;

enum GetProfileBillingRequestServiceGroup: string
{
    case PayIn = "PayIn";
    case PayOut = "PayOut";
}
