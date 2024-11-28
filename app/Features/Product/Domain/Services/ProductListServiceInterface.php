<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Services;

use App\Common\Domain\Entities\Paginator;
use App\Features\Product\Domain\Dto\ProductSearchParamsDtoInterface;
use Illuminate\Support\Collection;

interface ProductListServiceInterface
{
    public function execute(ProductSearchParamsDtoInterface $productSearchParamsDto): Paginator|Collection;
}
