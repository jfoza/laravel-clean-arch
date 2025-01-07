<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Validations;

use App\Enums\MessagesEnum;
use App\Exceptions\ConflictHttpException;
use App\Exceptions\NotFoundHttpException;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;

class ProductValidations
{
    /**
     * @throws NotFoundHttpException
     */
    public static function productExists(string $uuid, ProductRepositoryInterface $productRepository): Product
    {
        if(!$product = $productRepository->findByUuid($uuid)) {
            throw new NotFoundHttpException(MessagesEnum::PRODUCT_NOT_EXISTS);
        }

        return $product;
    }

    /**
     * @throws ConflictHttpException
     */
    public static function productNameExists(string $description, ProductRepositoryInterface $productRepository): void
    {
        if($productRepository->findByName($description)) {
            throw new ConflictHttpException(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS);
        }
    }

    /**
     * @throws ConflictHttpException
     */
    public static function updateProductNameExists(string $uuid, string $description, ProductRepositoryInterface $productRepository): void
    {
        $product = $productRepository->findByName($description);

        if($product && $product->uuid !== $uuid) {
            throw new ConflictHttpException(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS);
        }
    }
}
