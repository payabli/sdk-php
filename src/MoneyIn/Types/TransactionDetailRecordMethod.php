<?php

namespace Payabli\MoneyIn\Types;

enum TransactionDetailRecordMethod: string
{
    case Ach = "ach";
    case Card = "card";
}
