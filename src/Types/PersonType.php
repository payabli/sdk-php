<?php

namespace Payabli\Types;

enum PersonType: string
{
    case Owner = "Owner";
    case Director = "Director";
    case Contact = "Contact";
    case Signer = "Signer";
    case AuthorizedUser = "AuthorizedUser";
    case Employee = "Employee";
}
