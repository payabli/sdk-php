<?php

namespace Payabli\Types;

enum RequestPaymentValidatePaymentMethodMethod: string
{
    case Card = "card";
    case Cloud = "cloud";
}
