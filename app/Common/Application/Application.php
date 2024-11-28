<?php
declare(strict_types=1);

namespace App\Common\Application;

abstract class Application
{
    public Transaction $transaction {
        get => app(Transaction::class);
        set => $this->transaction = $value;
    }
}
