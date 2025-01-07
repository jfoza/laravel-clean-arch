<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Database\Eloquent\Mappers;

use App\Common\Domain\ValueObjects\UniqueEntityId;
use App\Common\Infra\Database\Eloquent\Mappers\EloquentModelMapper;
use App\Common\Infra\Database\Eloquent\Models\EloquentModel;
use App\Exceptions\InvalidArgumentException;
use App\Features\Product\Application\Factory\ProductFactory;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use Illuminate\Validation\ValidationException;

class EloquentProductMapper extends EloquentModelMapper
{
    public function from(EloquentModel|EloquentProductModel $model): Product
    {
        $props = ProductFactory::productProps();

        $props->description = $model[EloquentProductModel::DESCRIPTION];
        $props->uniqueName = UniqueProductDescription::assign($model[EloquentProductModel::UNIQUE_NAME]);
        $props->value = $model[EloquentProductModel::VALUE];
        $props->quantity = $model[EloquentProductModel::QUANTITY];
        $props->active = true;
        $props->details = $model[EloquentProductModel::DETAILS];

        return Product::create($props, UniqueEntityId::create($model[EloquentProductModel::UUID]));
    }
}
