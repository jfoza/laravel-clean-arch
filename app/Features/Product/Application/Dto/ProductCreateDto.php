<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Dto;

use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;

class ProductCreateDto implements ProductCreateDtoInterface
{
    public string $description {
        get => $this->description;
        set => $this->description = $value;
    }

    public null|string $details {
        get => $this->details;
        set => $this->details = $value;
    }

    public float $value {
        get => $this->value;
        set => $this->value = $value;
    }

    public int $quantity {
        get => $this->quantity;
        set => $this->quantity = $value;
    }
}
