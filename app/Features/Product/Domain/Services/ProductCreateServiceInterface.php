<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Services;

use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;
use App\Features\Product\Domain\Entities\Product;

interface ProductCreateServiceInterface
{
    public function execute(ProductCreateDtoInterface $productCreateDTO): Product;
}
