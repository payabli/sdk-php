<?php

namespace Payabli\Types;

enum DocumentSubjectType: string
{
    case Business = "business";
    case Paypoint = "paypoint";
    case Person = "person";
}
