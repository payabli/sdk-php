<?php

namespace Payabli\Types;

enum BusinessDetailResponseLegalStructure: string
{
    case LimitedLiabilityCompany = "LimitedLiabilityCompany";
    case Corporation = "Corporation";
    case Partnership = "Partnership";
    case SoleProprietorship = "SoleProprietorship";
    case NonProfit = "NonProfit";
    case Government = "Government";
    case SCorporation = "SCorporation";
}
