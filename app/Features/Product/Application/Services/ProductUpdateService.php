<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Exceptions\AppException;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Dto\ProductUpdateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductUpdateServiceInterface;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use Exception;

class ProductUpdateService extends Application implements ProductUpdateServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws AppException
     * @throws Exception
     */
    public function execute(string $uuid, ProductUpdateDtoInterface $productUpdateDto): Product
    {
        $product = ProductValidations::productExists($uuid, $this->productRepository);

        ProductValidations::updateProductNameExists($uuid, $productUpdateDto->description, $this->productRepository);

        $this->transaction->begin();

        try {
            $product->description = $productUpdateDto->description;
            $product->details = $productUpdateDto->details;
            $product->value = $productUpdateDto->value;
            $product->quantity = $productUpdateDto->quantity;
            $product->active = $productUpdateDto->active;
            $product->updateUniqueName(UniqueProductDescription::create($productUpdateDto->description));

            $this->productRepository->update($product);

            $this->transaction->commit();

            return $product;
        } catch (Exception $e) {
            $this->transaction->rollBack();

            throw $e;
        }
    }
}
