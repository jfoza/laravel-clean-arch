<?php

namespace App\Exceptions;

class UnauthorizedHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 401);
    }
}
