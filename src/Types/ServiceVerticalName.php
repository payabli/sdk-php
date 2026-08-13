<?php

namespace Payabli\Types;

enum ServiceVerticalName: string
{
    case PayIn = "PayIn";
    case PayOut = "PayOut";
    case PayOps = "PayOps";
}
