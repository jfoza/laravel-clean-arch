<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Entities;

use App\Common\Domain\Entities\Entity;
use App\Common\Domain\ValueObjects\Date;
use App\Common\Domain\ValueObjects\UniqueEntityId;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;

class Product extends Entity
{
    private function __construct(private readonly ProductProps $props, ?UniqueEntityId $uniqueEntityId = null)
    {
        $this->props->createdAt = $this->props->createdAt ?: Date::create();
        parent::__construct($uniqueEntityId);
    }

    public string $description {
        get => $this->props->description;
        set => $this->props->description = $value;
    }

    public ?string $details {
        get => $this->props->details;
        set => $this->props->details = $value;
    }

    public string $uniqueName {
        get => $this->props->uniqueName->toString();
    }

    public float $value {
        get => $this->props->value;
        set => $this->props->value = $value;
    }

    public int $quantity {
        get => $this->props->quantity;
        set => $this->props->quantity = $value;
    }

    public bool $active {
        get => $this->props->active;
        set => $this->props->active = $value;
    }

    public string $createdAt {
        get => $this->props->createdAt->toValue();
    }

    public static function create(ProductProps $props, ?UniqueEntityId $uniqueEntityId = null): Product
    {
        return new self($props, $uniqueEntityId);
    }

    public function updateUniqueName(UniqueProductDescription $uniqueProductDescription): void
    {
        $this->props->uniqueName = $uniqueProductDescription;
    }
}
