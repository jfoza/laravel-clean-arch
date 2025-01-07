<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Exceptions\NotFoundHttpException;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductRemoveServiceInterface;
use Exception;

class ProductRemoveService extends Application implements ProductRemoveServiceInterface
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function execute(string $uuid): void
    {
        $product = ProductValidations::productExists($uuid, $this->productRepository);

        $this->transaction->begin();

        try {
            $this->productRepository->remove($product);

            $this->transaction->commit();
        } catch (Exception $e) {
            $this->transaction->rollBack();

            throw $e;
        }
    }
}
