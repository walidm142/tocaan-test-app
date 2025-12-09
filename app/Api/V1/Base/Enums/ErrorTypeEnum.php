<?php

namespace App\Api\V1\Base\Enums;

enum ErrorTypeEnum : string
{
    case INVALID_CREDENTIALS = '1';

    case JWT_EXCEPTION = '2';

    case FAILED_TO_LOGOUT = '3';
}
