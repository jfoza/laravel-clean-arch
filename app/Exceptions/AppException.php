<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    public function __construct(
        $message,
        $code = 0,
    )
    {
        parent::__construct(is_array($message) ? json_encode($message) : $message, $code);
    }
}

