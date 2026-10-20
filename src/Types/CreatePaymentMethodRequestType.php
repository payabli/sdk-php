<?php

namespace Payabli\Types;

enum CreatePaymentMethodRequestType: string
{
    case BankAccount = "bank_account";
}
