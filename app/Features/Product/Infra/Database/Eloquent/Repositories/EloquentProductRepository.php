<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Database\Eloquent\Repositories;

use App\Common\Domain\Entities\Paginator;
use App\Features\Product\Domain\Dto\ProductSearchParamsDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Infra\Database\Eloquent\Mappers\ProductMapper;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use Illuminate\Support\Collection;

readonly class EloquentProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private EloquentProductModel $eloquentProductModel,
        private ProductMapper $productMapper
    )
    {
    }

    public function findAll(ProductSearchParamsDtoInterface $productSearchParamsDto): Collection
    {
        $result = $this->eloquentProductModel->get();

        return $this->productMapper->collection($result);
    }

    public function paginate(ProductSearchParamsDtoInterface $productSearchParamsDto): Paginator
    {
        $builder = $this->getBaseQueryFilters($productSearchParamsDto);

        return $this->productMapper->pagination($builder, $productSearchParamsDto);
    }

    public function findByUuid(string $uuid): ?Product
    {
        $result = $this->eloquentProductModel->where(EloquentProductModel::UUID, $uuid)->first();

        return $this->productMapper->optional($result);
    }

    public function findByName(string $description): ?Product
    {
        $result = $this->eloquentProductModel->where(EloquentProductModel::DESCRIPTION, $description)->first();

        return $this->productMapper->optional($result);
    }

    public function create(Product $product): ?Product
    {
        $create = [
            EloquentProductModel::UUID => $product->uuid,
            EloquentProductModel::DESCRIPTION => $product->description,
            EloquentProductModel::DETAILS => $product->details,
            EloquentProductModel::UNIQUE_NAME => $product->uniqueName,
            EloquentProductModel::VALUE => $product->value,
            EloquentProductModel::QUANTITY => $product->quantity,
            EloquentProductModel::ACTIVE => $product->active,
            EloquentProductModel::CREATED_AT => $product->createdAt,
        ];

        $this->eloquentProductModel->create($create);

        return $product;
    }

    public function update(Product $product): ?Product
    {
        $update = [
            EloquentProductModel::DESCRIPTION => $product->description,
            EloquentProductModel::DETAILS => $product->details,
            EloquentProductModel::UNIQUE_NAME => $product->uniqueName,
            EloquentProductModel::VALUE => $product->value,
            EloquentProductModel::QUANTITY => $product->quantity,
            EloquentProductModel::ACTIVE => $product->active,
        ];

        $this->eloquentProductModel->where(EloquentProductModel::UUID, $product->uuid)->update($update);

        return $product;
    }

    public function remove(Product $product): void
    {
        $this->eloquentProductModel->where(EloquentProductModel::UUID, $product->uuid)->delete();
    }

    private function getBaseQueryFilters(ProductSearchParamsDtoInterface $productSearchParamsDto) {
        $select = [
            EloquentProductModel::UUID,
            EloquentProductModel::DESCRIPTION,
            EloquentProductModel::DETAILS,
            EloquentProductModel::UNIQUE_NAME,
            EloquentProductModel::VALUE,
            EloquentProductModel::QUANTITY,
            EloquentProductModel::ACTIVE,
            EloquentProductModel::CREATED_AT,
        ];

        return $this
            ->eloquentProductModel
            ->select($select)
            ->when(
                !is_null($productSearchParamsDto->description),
                fn($q) => $q->where(
                    EloquentProductModel::DESCRIPTION,
                    'ILIKE',
                    '%'. $productSearchParamsDto->description .'%'
                )
            )
            ->when(
                !is_null($productSearchParamsDto->uniqueName),
                fn($q) => $q->where(
                    EloquentProductModel::UNIQUE_NAME,
                    $productSearchParamsDto->uniqueName
                )
            )
            ->when(
                !is_null($productSearchParamsDto->active),
                fn($q) => $q->where(
                    EloquentProductModel::ACTIVE,
                    $productSearchParamsDto->active
                )
            );
    }
}
