<?php

namespace App\Enums\V1;

enum ErrorTypeEnum : string
{
    case INVALID_CREDENTIALS = '1';

    case JWT_EXCEPTION = '2';
}
