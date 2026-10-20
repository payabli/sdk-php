<?php

namespace Payabli\Types;

enum PaymentMethodUsage: string
{
    case Deposits = "deposits";
    case Billing = "billing";
    case Withdrawals = "withdrawals";
    case PayOutFunding = "payOutFunding";
    case Refunds = "refunds";
    case Returns = "returns";
}
