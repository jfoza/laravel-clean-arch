<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Props;

use App\Common\Domain\ValueObjects\Date;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;

interface ProductProps
{
    public string $description { get; set; }
    public ?string $details { get; set; }
    public UniqueProductDescription $uniqueName { get; set; }
    public float $value { get; set; }
    public int $quantity { get; set; }
    public bool $active { get; set; }
    public ?Date $createdAt { get; set; }
}
