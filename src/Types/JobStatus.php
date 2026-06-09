<?php

namespace Payabli\Types;

enum JobStatus: string
{
    case InProgress = "in_progress";
    case Completed = "completed";
    case Failed = "failed";
}
