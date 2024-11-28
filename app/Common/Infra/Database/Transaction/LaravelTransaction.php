<?php
declare(strict_types=1);

namespace App\Common\Infra\Database\Transaction;

use App\Common\Application\Transaction;
use Illuminate\Support\Facades\DB;

class LaravelTransaction implements Transaction
{
    public function begin(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}
