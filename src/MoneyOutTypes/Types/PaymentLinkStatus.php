<?php

namespace Payabli\MoneyOutTypes\Types;

enum PaymentLinkStatus: string
{
    case Active = "Active";
    case Expired = "Expired";
    case Canceled = "Canceled";
    case Deleted = "Deleted";
}
