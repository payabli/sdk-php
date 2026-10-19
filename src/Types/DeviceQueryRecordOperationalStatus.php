<?php

namespace Payabli\Types;

enum DeviceQueryRecordOperationalStatus: string
{
    case Online = "online";
    case Busy = "busy";
    case Offline = "offline";
}
