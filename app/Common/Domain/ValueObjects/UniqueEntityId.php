<?php
declare(strict_types=1);

namespace App\Common\Domain\ValueObjects;

use App\Libraries\Uuid\Uuid;

class UniqueEntityId extends SimpleValueObject
{
    private string $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value ?? Uuid::v4();
    }
    public function toValue(): string
    {
        return $this->value;
    }

    public static function create(?string $value = null): UniqueEntityId
    {
        return new self($value);
    }
}
