<?php
declare(strict_types=1);

namespace App\Common\Infra\Database\Eloquent\Mappers;

use App\Common\Domain\Dto\SearchParamsInterface;
use App\Common\Domain\Entities\Entity;
use App\Common\Domain\Entities\Paginator;
use App\Common\Infra\Database\Eloquent\Models\EloquentModel;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;

abstract class EloquentModelMapper
{
    abstract public function from(EloquentModel $model): Entity;

    public function optional(?EloquentModel $model = null): ?Entity {
        if(!$model) {
            return null;
        }
        return $this->from($model);
    }

    public function collection(Collection $model): Collection {
        return $model->map(fn($item) => $this->from($item));
    }

    public function pagination(QueryBuilder|EloquentBuilder $builder, SearchParamsInterface $searchParams): Paginator
    {
        $paginator = $builder->paginate(
            $searchParams->perPage,
            ['*'],
            'page',
            $searchParams->page,
        );

        if($paginator->getCollection()->isNotEmpty())
        {
            $paginator->getCollection()->transform(fn($item) => $this->from($item));
        }

        return Paginator::create(
            currentPage: $paginator->currentPage(),
            data: $paginator->items(),
            from: $paginator->firstItem(),
            lastPage: $paginator->lastPage(),
            perPage: $paginator->perPage(),
            total: $paginator->total(),
            to: $paginator->lastItem(),
        );
    }
}
