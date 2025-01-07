<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Factory;

use App\Common\Domain\ValueObjects\Date;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;

class ProductFactory
{
    public static function productProps(): ProductProps
    {
        return new class implements ProductProps
        {
            public string $description;
            public ?string $details = null;
            public UniqueProductDescription $uniqueName;
            public float $value;
            public int $quantity;
            public bool $active;
            public ?Date $createdAt = null;
        };
    }
}
