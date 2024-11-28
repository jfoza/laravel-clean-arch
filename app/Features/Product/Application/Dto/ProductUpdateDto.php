<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Dto;

use App\Features\Product\Domain\Dto\ProductUpdateDtoInterface;

class ProductUpdateDto extends ProductCreateDto implements ProductUpdateDtoInterface
{
    public bool $active {
        get => $this->active;
        set => $this->active = $value;
    }
}
