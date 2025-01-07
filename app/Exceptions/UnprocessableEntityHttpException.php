<?php

namespace App\Exceptions;

class UnprocessableEntityHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 422);
    }
}
