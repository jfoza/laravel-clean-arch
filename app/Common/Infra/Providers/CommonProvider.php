<?php
declare(strict_types=1);

namespace App\Common\Infra\Providers;

use App\Common\Application\Transaction;
use App\Common\Infra\Database\Transaction\LaravelTransaction;
use App\Providers\AppServiceProvider;

class CommonProvider extends AppServiceProvider
{
    public array $singletons = [Transaction::class => LaravelTransaction::class];
}
