<?php

namespace Payabli\Types;

enum DocumentRequirementSource: string
{
    case Template = "template";
    case BusinessRule = "businessRule";
}
