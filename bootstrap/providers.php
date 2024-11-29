<?php

return [
    \App\Libraries\LaravelInjectable\Src\InjectionServiceProvider::class,
    \App\Providers\AppServiceProvider::class,
    \App\Common\Infra\Providers\CommonProvider::class,
    \App\Features\Product\Infra\Providers\ProductProvider::class,
];
