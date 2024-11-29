<?php
declare(strict_types=1);

namespace App\Common\Domain\ValueObjects;

abstract class ValueObject
{
    abstract public static function create(mixed $value): mixed;
    abstract public static function assign(mixed $value): mixed;
    abstract public function toString(): string;
}
