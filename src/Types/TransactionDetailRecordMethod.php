<?php

namespace Payabli\Types;

enum TransactionDetailRecordMethod: string
{
    case Ach = "ach";
    case Card = "card";
}
