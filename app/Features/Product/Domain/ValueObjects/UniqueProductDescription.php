<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\ValueObjects;

use App\Common\Domain\ValueObjects\ValueObject;
use App\Libraries\LaravelCleanArchHelpers\Src\UniqueString;

class UniqueProductDescription extends ValueObject
{
    private function __construct(private readonly string $uniqueName)
    {
    }

    public static function create($value): UniqueProductDescription
    {
        $normalized = UniqueString::generate($value);
        return new self($normalized);
    }

    public static function assign($value): UniqueProductDescription
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->uniqueName;
    }
}
