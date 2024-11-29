<?php
declare(strict_types=1);

namespace App\Features\Product\Application\Services;

use App\Common\Application\Application;
use App\Exceptions\AppException;
use App\Features\Product\Application\Validations\ProductValidations;
use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductCreateServiceInterface;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use App\Libraries\LaravelInjectable\Src\Inject;
use Exception;

class ProductCreateService extends Application implements ProductCreateServiceInterface
{
    #[Inject(ProductProps::class)]
    protected ProductProps $props;

    public function __construct(protected readonly ProductRepositoryInterface $productRepository)
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
            $this->setProps($productCreateDTO);

            $product = Product::create($this->props);

            $this->productRepository->create($product);

            $this->transaction->commit();

            return $product;
        } catch (Exception $e) {
            $this->transaction->rollBack();

            throw $e;
        }
    }

    private function setProps(ProductCreateDtoInterface $productCreateDTO): void
    {
        $this->props->description = $productCreateDTO->description;
        $this->props->details = $productCreateDTO->details;
        $this->props->uniqueName = UniqueProductDescription::create($productCreateDTO->description);
        $this->props->value = $productCreateDTO->value;
        $this->props->quantity = $productCreateDTO->quantity;
        $this->props->active = true;
    }
}
