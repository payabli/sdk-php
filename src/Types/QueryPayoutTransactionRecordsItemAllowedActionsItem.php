<?php

namespace Payabli\Types;

enum QueryPayoutTransactionRecordsItemAllowedActionsItem: string
{
    case Capture = "capture";
    case Cancel = "cancel";
    case Reissue = "reissue";
}
