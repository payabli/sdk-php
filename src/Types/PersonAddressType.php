<?php

namespace Payabli\Types;

enum PersonAddressType: string
{
    case Legal = "legal";
    case Billing = "billing";
    case Shipping = "shipping";
    case Remittance = "remittance";
    case Mailing = "mailing";
    case Physical = "physical";
    case Residential = "residential";
}
