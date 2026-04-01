<?php

namespace App\Enum;

enum UserRole: string
{
    case SuperAdmin = "super_admin";
    case Admin = "admin";
    case Student = "student";
    case Recipient = "recipient";
}
