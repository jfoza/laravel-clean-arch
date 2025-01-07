<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Dto;

interface ProductCreateDtoInterface
{
    public string $description { get; set; }
    public string|null $details { get; set; }
    public float $value { get; set; }
    public int $quantity { get; set; }
}
