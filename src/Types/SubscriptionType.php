<?php

namespace Payabli\Types;

enum SubscriptionType: string
{
    case Regular = "Regular";
    case BalanceDriven = "BalanceDriven";
}
