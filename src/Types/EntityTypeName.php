<?php

namespace Payabli\Types;

enum EntityTypeName: string
{
    case Organization = "Organization";
    case Paypoint = "Paypoint";
    case Customer = "Customer";
    case Template = "Template";
    case Application = "Application";
    case BankAccount = "BankAccount";
    case Address = "Address";
}
