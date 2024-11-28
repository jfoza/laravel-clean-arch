<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Dto;

use App\Common\Domain\Dto\SearchParamsInterface;

interface ProductSearchParamsDtoInterface extends SearchParamsInterface
{
    public string|null $description { get; set; }
    public string|null $uniqueName { get; set; }
    public bool|null $active { get; set; }
}
