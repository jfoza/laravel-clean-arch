<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Database\Eloquent\Mappers;

use App\Common\Domain\Exceptions\InvalidArgumentException;
use App\Common\Infra\Database\Eloquent\Mappers\Mapper;
use App\Common\Infra\Database\Eloquent\Models\EloquentModel;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use Illuminate\Validation\ValidationException;

class ProductMapper extends Mapper
{
    /**
     * @throws InvalidArgumentException
     * @throws ValidationException
     */
    public function from(EloquentModel|EloquentProductModel $model): Product
    {
        return Product::create($model->toArray(), $model['uuid']);
    }
}
