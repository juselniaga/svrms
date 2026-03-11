<?php

namespace App\Enums;

enum UserRole: string
{
    case Developer = 'Developer';
    case Clerk = 'Clerk';
    case Officer = 'Officer';
    case AssistantDirector = 'Assistant Director';
    case Director = 'Director';
    case Admin = 'Admin';
}
