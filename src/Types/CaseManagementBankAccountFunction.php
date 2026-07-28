<?php

namespace Payabli\Types;

enum CaseManagementBankAccountFunction: string
{
    case Deposits = "Deposits";
    case Withdrawals = "Withdrawals";
    case DepositsAndWithdrawals = "DepositsAndWithdrawals";
    case Remittances = "Remittances";
    case RemittancesAndDeposits = "RemittancesAndDeposits";
    case RemittancesAndWithdrawals = "RemittancesAndWithdrawals";
    case RemittancesDepositsAndWithdrawals = "RemittancesDepositsAndWithdrawals";
}
