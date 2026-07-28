<?php

namespace Payabli\Types;

enum BankReviewDecisionReason: string
{
    case CreditDecline = "CreditDecline";
    case FraudDecline = "FraudDecline";
    case KybKycDecline = "KybKycDecline";
    case Withdrawn = "Withdrawn";
}
