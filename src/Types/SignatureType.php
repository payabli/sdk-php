<?php

namespace Payabli\Types;

enum SignatureType: string
{
    case Type = "type";
    case Draw = "draw";
    case Checkbox = "checkbox";
}
