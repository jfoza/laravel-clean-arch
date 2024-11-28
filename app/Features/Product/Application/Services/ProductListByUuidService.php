<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Common\Application\Exceptions\AppException;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductListByUuidServiceInterface;

class ProductListByUuidService extends Application implements ProductListByUuidServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws AppException
     */
    public function execute(string $uuid): Product
    {
        return ProductValidations::productExists($uuid, $this->productRepository);
    }
}
