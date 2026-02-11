<?php

namespace Payabli\MoneyOutTypes\Types;

enum AllowedCheckPaymentStatus: string
{
    case Cancelled = "0";
    case Paid = "5";
}
