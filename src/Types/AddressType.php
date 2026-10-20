<?php

namespace Payabli\Types;

enum AddressType: string
{
    case Legal = "legal";
    case Billing = "billing";
    case Shipping = "shipping";
    case Remittance = "remittance";
    case Physical = "physical";
    case Mailing = "mailing";
}
