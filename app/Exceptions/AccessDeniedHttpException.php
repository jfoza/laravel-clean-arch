<?php

namespace App\Exceptions;

class AccessDeniedHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 403);
    }
}
