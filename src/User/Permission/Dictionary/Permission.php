<?php

declare(strict_types=1);

namespace App\User\Permission\Dictionary;

enum Permission
{
    case COMPANY_DISPLAY;
    case COMPANY_EDIT;
    case COMPANY_DELETE;
}