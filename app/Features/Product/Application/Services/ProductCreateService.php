<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Common\Application\Exceptions\AppException;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductCreateServiceInterface;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use Exception;

class ProductCreateService extends Application implements ProductCreateServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws AppException
     * @throws Exception
     */
    public function execute(ProductCreateDtoInterface $productCreateDTO): Product
    {
        ProductValidations::productNameExists($productCreateDTO->description, $this->productRepository);

        $this->transaction->begin();

        try {
            $product = Product::create([
                'description' => $productCreateDTO->description,
                'details' => $productCreateDTO->details,
                'uniqueName' => UniqueProductDescription::create($productCreateDTO->description),
                'value' => $productCreateDTO->value,
                'quantity' => $productCreateDTO->quantity,
                'active' => true,
            ]);

            $this->productRepository->create($product);

            $this->transaction->commit();

            return $product;
        } catch (Exception $e) {
            $this->transaction->rollBack();

            throw $e;
        }
    }
}
