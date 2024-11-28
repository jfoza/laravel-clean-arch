<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Services;

use App\Features\Product\Domain\Dto\ProductUpdateDtoInterface;
use App\Features\Product\Domain\Entities\Product;

interface ProductUpdateServiceInterface
{
    public function execute(string $uuid, ProductUpdateDtoInterface $productUpdateDto): Product;
}
