<?php

namespace Payabli\Types;

enum VendorPaymentMethodMethod: string
{
    case Managed = "managed";
    case Vcard = "vcard";
    case Ach = "ach";
    case Check = "check";
}
