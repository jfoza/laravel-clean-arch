<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Providers;

use App\Features\Product\Application\Services\ProductCreateService;
use App\Features\Product\Application\Services\ProductListByUuidService;
use App\Features\Product\Application\Services\ProductListService;
use App\Features\Product\Application\Services\ProductRemoveService;
use App\Features\Product\Application\Services\ProductUpdateService;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Features\Product\Domain\Services\ProductCreateServiceInterface;
use App\Features\Product\Domain\Services\ProductListByUuidServiceInterface;
use App\Features\Product\Domain\Services\ProductListServiceInterface;
use App\Features\Product\Domain\Services\ProductRemoveServiceInterface;
use App\Features\Product\Domain\Services\ProductUpdateServiceInterface;
use App\Features\Product\Infra\Database\Eloquent\Repositories\EloquentProductRepository;
use App\Providers\AppServiceProvider;

class ProductProvider extends AppServiceProvider
{
    public array $bindings = [
        ProductProps::class => ProductProps::class,
        ProductRepositoryInterface::class => EloquentProductRepository::class,
        ProductListServiceInterface::class => ProductListService::class,
        ProductListByUuidServiceInterface::class => ProductListByUuidService::class,
        ProductCreateServiceInterface::class => ProductCreateService::class,
        ProductUpdateServiceInterface::class => ProductUpdateService::class,
        ProductRemoveServiceInterface::class => ProductRemoveService::class,
    ];
}
