<?php

namespace Payabli\Types;

enum BusinessAddressLocation: string
{
    case Office = "office";
    case Warehouse = "warehouse";
    case Retail = "retail";
    case Home = "home";
    case Other = "other";
}
