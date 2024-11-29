<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Dto;

use App\Common\Application\Dto\SearchParams;
use App\Features\Product\Domain\Dto\ProductSearchParamsDtoInterface;

class ProductSearchParamsDto implements ProductSearchParamsDtoInterface
{
    use SearchParams;

    public string|null $description {
        get => $this->description;
        set => $this->description = $value ?: null;
    }

    public string|null $uniqueName {
        get => $this->uniqueName;
        set => $this->uniqueName = $value ?: null;
    }

    public bool|null $active {
        get => $this->active;
        set => $this->active = $value ?: null;
    }
}
