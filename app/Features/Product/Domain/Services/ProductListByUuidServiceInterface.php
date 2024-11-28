<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Services;

use App\Features\Product\Domain\Entities\Product;

interface ProductListByUuidServiceInterface
{
    public function execute(string $uuid): Product;
}
