<?php

namespace Payabli\Types;

enum CaseTrigger: string
{
    case Submit = "Submit";
    case Verify = "Verify";
    case RequestReview = "RequestReview";
    case Assign = "Assign";
    case RequestResponse = "RequestResponse";
    case Escalate = "Escalate";
    case Approve = "Approve";
    case AutoApprove = "AutoApprove";
    case RequestCompletion = "RequestCompletion";
    case Complete = "Complete";
    case Deny = "Deny";
    case Error = "Error";
}
