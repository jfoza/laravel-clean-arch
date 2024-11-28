<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Services\DataBuilder;

use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;

class ProductDataBuilder
{
    public static function getProductProps(): ProductProps
    {
        $productProps = new ProductProps();
        $productProps->description = 'Test Description';
        $productProps->details = 'Test Details';
        $productProps->uniqueName = 'test-description';
        $productProps->value = 10.50;
        $productProps->quantity = 40;
        $productProps->active = true;

        return $productProps;
    }

    public static function getProduct(): Product
    {
        return new Product(self::getProductProps());
    }
}
