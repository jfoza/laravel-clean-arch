<?php
declare(strict_types=1);

namespace App\Common\Infra\Providers;

use App\Common\Application\Transaction;
use App\Common\Infra\Database\Transaction\LaravelTransaction;
use App\Providers\AppServiceProvider;

class CommonProvider extends AppServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->singleton(Transaction::class, LaravelTransaction::class);
    }
}
