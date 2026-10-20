<?php

namespace Payabli\Types;

enum CaseManagementMoneyOutService: string
{
    case Ach = "Ach";
    case VCard = "VCard";
    case Managed = "Managed";
    case Check = "Check";
    case Rtp = "Rtp";
    case Wire = "Wire";
    case Ghost = "Ghost";
}
