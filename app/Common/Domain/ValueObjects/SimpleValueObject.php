<?php
declare(strict_types=1);

namespace App\Common\Domain\ValueObjects;

abstract class SimpleValueObject
{
    abstract public function toValue(): string|int|float|bool;
}
