<?php
declare(strict_types=1);

namespace App\Exceptions;

class InvalidArgumentException extends AppException
{
    public function __construct(string|array $message = '')
    {
        parent::__construct($message, 400);
    }
}
