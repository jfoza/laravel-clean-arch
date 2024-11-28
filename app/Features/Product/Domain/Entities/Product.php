<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Entities;

use App\Common\Domain\Entities\Entity;
use App\Common\Domain\Exceptions\InvalidArgumentException;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\Validators\ProductValidator;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use Illuminate\Validation\ValidationException;

class Product extends Entity
{
    private function __construct(private readonly ProductProps $props, ?string $uuid = null)
    {
        $this->props->createdAt = $this->props->createdAt ?: $this->currentDate;
        parent::__construct($uuid);
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
        set => $this->props->uniqueName = new UniqueProductDescription($value);
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
        get => $this->props->createdAt;
    }

    /**
     * @throws InvalidArgumentException
     * @throws ValidationException
     */
    private static function normalize(array $propsArr): ProductProps
    {
        return ProductValidator::normalize($propsArr);
    }

    /**
     * @throws ValidationException
     * @throws InvalidArgumentException
     */
    public static function create(array $propsArr, ?string $uuid = null): Product
    {
        $props = self::normalize($propsArr);
        return new self($props, $uuid);
    }

    public function updateUniqueName(UniqueProductDescription $uniqueProductDescription): void
    {
        $this->props->uniqueName = $uniqueProductDescription;
    }
}
