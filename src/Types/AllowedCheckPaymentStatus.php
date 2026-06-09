<?php

namespace Payabli\Types;

enum AllowedCheckPaymentStatus: string
{
    case Cancelled = "0";
    case Paid = "5";
}
