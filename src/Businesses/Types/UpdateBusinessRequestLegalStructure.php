<?php

namespace Payabli\Businesses\Types;

enum UpdateBusinessRequestLegalStructure: string
{
    case LimitedLiabilityCompany = "limited-liability-company";
    case Llc = "llc";
    case Corporation = "corporation";
    case Partnership = "partnership";
    case SoleProprietorship = "sole-proprietorship";
    case NonProfit = "non-profit";
    case Government = "government";
    case SCorp = "s-corp";
    case SCorporation = "s-corporation";
}
