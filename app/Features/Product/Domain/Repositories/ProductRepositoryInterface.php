<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Repositories;

use App\Common\Domain\Entities\Paginator;
use App\Features\Product\Domain\Dto\ProductSearchParamsDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function findAll(ProductSearchParamsDtoInterface $productSearchParamsDto): Collection;
    public function paginate(ProductSearchParamsDtoInterface $productSearchParamsDto): Paginator;
    public function findByUuid(string $uuid): ?Product;
    public function findByName(string $description): ?Product;
    public function create(Product $product): ?Product;
    public function update(Product $product): ?Product;
    public function remove(Product $product): void;
}
