<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Database\Eloquent\Mappers;

use App\Common\Domain\Exceptions\InvalidArgumentException;
use App\Common\Infra\Database\Eloquent\Mappers\EloquentModelMapper;
use App\Common\Infra\Database\Eloquent\Models\EloquentModel;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use App\Libraries\LaravelInjectable\Src\Inject;
use Illuminate\Validation\ValidationException;

class EloquentProductMapper extends EloquentModelMapper
{
    #[Inject(ProductProps::class)]
    protected ProductProps $props;

    /**
     * @throws InvalidArgumentException
     * @throws ValidationException
     */
    public function from(EloquentModel|EloquentProductModel $model): Product
    {
        $this->props->description = $model[EloquentProductModel::DESCRIPTION];
        $this->props->uniqueName = UniqueProductDescription::assign($model[EloquentProductModel::UNIQUE_NAME]);
        $this->props->value = $model[EloquentProductModel::VALUE];
        $this->props->quantity = $model[EloquentProductModel::QUANTITY];
        $this->props->active = true;
        $this->props->details = $model[EloquentProductModel::DETAILS];

        return Product::create($this->props, $model[EloquentProductModel::UUID]);
    }
}
