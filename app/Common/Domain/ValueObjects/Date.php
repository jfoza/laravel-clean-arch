<?php
declare(strict_types=1);

namespace App\Common\Domain\ValueObjects;

use App\Exceptions\InvalidArgumentException;
use DateTime;

class Date extends SimpleValueObject
{
    private string $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value ?? date('Y-m-d H:i:s');
    }

    public function toValue(): string
    {
        return $this->value;
    }

    public static function create(?string $value = null): Date
    {
        return new self($value);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function createFrom(?string $value = null): Date
    {
        if ($value !== null && !self::isValidDate($value)) {
            throw new InvalidArgumentException("Invalid date format. Expected format: yyyy-mm-dd");
        }

        return new self($value);
    }

    private static function isValidDate(string $date): bool
    {
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
