<?php
declare(strict_types=1);

namespace App\Common\Domain\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    private mixed $options {
        get => $this->options;
    }

    public function __construct(
        $message,
        $code = 400,
        ?Exception $previous = null,
        $options = []
    )
    {
        parent::__construct(json_encode($message), $code, $previous);

        $this->options = $options;
    }
}
