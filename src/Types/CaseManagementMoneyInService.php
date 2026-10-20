<?php

namespace Payabli\Types;

enum CaseManagementMoneyInService: string
{
    case Ach = "Ach";
    case Card = "Card";
    case Cloud = "Cloud";
    case Device = "Device";
    case Wallet = "Wallet";
    case Cash = "Cash";
    case Check = "Check";
}
