<?php

namespace App\Exceptions;

class NotFoundHttpException extends AppException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, 404);
    }
}
