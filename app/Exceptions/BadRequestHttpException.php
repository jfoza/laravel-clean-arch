<?php

namespace App\Exceptions;

class BadRequestHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 400);
    }
}
