<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Exceptions\ConflictHttpException;
use App\Exceptions\InvalidArgumentException;
use App\Features\Product\Application\Factory\ProductFactory;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductCreateServiceInterface;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use App\Libraries\LaravelInjectable\Src\Inject;
use Exception;
use Illuminate\Validation\ValidationException;

class ProductCreateService extends Application implements ProductCreateServiceInterface
{
    public function __construct(protected readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @throws ConflictHttpException
     * @throws ValidationException
     * @throws InvalidArgumentException
     */
    public function execute(ProductCreateDtoInterface $productCreateDTO): Product
    {
        ProductValidations::productNameExists($productCreateDTO->description, $this->productRepository);

        $this->transaction->begin();

        try {
            $props = ProductFactory::productProps();

            $props->description = $productCreateDTO->description;
            $props->details = $productCreateDTO->details;
            $props->uniqueName = UniqueProductDescription::create($productCreateDTO->description);
            $props->value = $productCreateDTO->value;
            $props->quantity = $productCreateDTO->quantity;
            $props->active = true;

            $product = Product::create($props);

            $this->productRepository->create($product);

            $this->transaction->commit();

            return $product;
        } catch (Exception $e) {
            $this->transaction->rollBack();

            throw $e;
        }
    }
}
