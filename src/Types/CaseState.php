<?php

namespace Payabli\Types;

enum CaseState: string
{
    case Submitted = "Submitted";
    case Verifying = "Verifying";
    case PendingReview = "PendingReview";
    case Assigned = "Assigned";
    case PendingResponse = "PendingResponse";
    case Escalated = "Escalated";
    case Approved = "Approved";
    case AutoApproved = "AutoApproved";
    case PendingCompletion = "PendingCompletion";
    case Completed = "Completed";
    case Denied = "Denied";
    case Error = "Error";
}
