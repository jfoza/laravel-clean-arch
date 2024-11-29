<?php
declare(strict_types=1);

namespace App\Common\Application;

use App\Libraries\LaravelInjectable\Src\Inject;

abstract class Application
{
    #[Inject(Transaction::class)]
    public Transaction $transaction;
}
