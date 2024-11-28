<?php
declare(strict_types=1);

namespace App\Common\Infra\Database\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EloquentModel extends Model
{
    public function toArray(): array
    {
        $array = parent::toArray();

        return collect($array)->mapWithKeys(fn ($value, $key) => [Str::camel($key) => $value])->toArray();
    }
}
