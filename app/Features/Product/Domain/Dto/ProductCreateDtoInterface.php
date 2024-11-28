<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Dto;

interface ProductCreateDtoInterface
{
    public string $description { get; }
    public string|null $details { get; }
    public string $validate { get; }
    public float $value { get; }
    public int $quantity { get; }
}
