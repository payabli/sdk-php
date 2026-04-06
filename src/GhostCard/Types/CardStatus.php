<?php

namespace Payabli\GhostCard\Types;

enum CardStatus: string
{
    case Active = "Active";
    case Inactive = "Inactive";
    case Cancelled = "Cancelled";
    case Expired = "Expired";
}
