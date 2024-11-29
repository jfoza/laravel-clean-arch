<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Validations;

use App\Enums\MessagesEnum;
use App\Exceptions\AppException;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductValidations
{
    /**
     * @throws AppException
     */
    public static function productExists(string $uuid, ProductRepositoryInterface $productRepository): Product
    {
        if(!$product = $productRepository->findByUuid($uuid)) {
            throw new AppException(MessagesEnum::PRODUCT_NOT_EXISTS, Response::HTTP_NOT_FOUND);
        }

        return $product;
    }

    /**
     * @throws AppException
     */
    public static function productNameExists(string $description, ProductRepositoryInterface $productRepository): void
    {
        if($productRepository->findByName($description)) {
            throw new AppException(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS, Response::HTTP_CONFLICT);
        }
    }

    /**
     * @throws AppException
     */
    public static function updateProductNameExists(string $uuid, string $description, ProductRepositoryInterface $productRepository): void
    {
        $product = $productRepository->findByName($description);

        if($product && $product->uuid !== $uuid) {
            throw new AppException(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS, Response::HTTP_CONFLICT);
        }
    }
}
