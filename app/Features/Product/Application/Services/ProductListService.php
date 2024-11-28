<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Common\Domain\Entities\Paginator;
use App\Features\Product\Domain\Dto\ProductSearchParamsDtoInterface;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductListServiceInterface;
use Illuminate\Support\Collection;

class ProductListService extends Application implements ProductListServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function execute(ProductSearchParamsDtoInterface $productSearchParamsDto): Paginator|Collection
    {
        if(is_null($productSearchParamsDto->page)) {
            return $this->productRepository->findAll($productSearchParamsDto);
        }

        return $this->productRepository->paginate($productSearchParamsDto);
    }
}
