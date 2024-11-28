<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Props;

use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;

class ProductProps
{
    public string $description;
    public ?string $details = null;
    public UniqueProductDescription $uniqueName;
    public float $value;
    public int $quantity;
    public bool $active;
    public ?string $createdAt = null;
}
