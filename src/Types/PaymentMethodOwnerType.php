<?php

namespace Payabli\Types;

enum PaymentMethodOwnerType: string
{
    case Person = "person";
    case Business = "business";
}
