<?php

namespace Payabli\Types;

enum UnderwritingMode: string
{
    case Automatic = "automatic";
    case Manual = "manual";
    case Bypass = "bypass";
}
