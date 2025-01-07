<?php

namespace App\Exceptions;

class TooManyRequestsHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 429);
    }
}
