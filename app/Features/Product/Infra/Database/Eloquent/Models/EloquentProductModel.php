<?php
declare(strict_types=1);

namespace App\Features\Product\Infra\Database\Eloquent\Models;

use App\Common\Infra\Database\Eloquent\Models\EloquentModel;

class EloquentProductModel extends EloquentModel
{
    const string UUID        = 'uuid';
    const string DESCRIPTION = 'description';
    const string DETAILS     = 'details';
    const string UNIQUE_NAME = 'unique_name';
    const string VALUE       = 'value';
    const string QUANTITY    = 'quantity';
    const string ACTIVE      = 'active';
    const string CREATED_AT  = 'created_at';

    protected $table = 'products';

    protected $primaryKey = self::UUID;

    protected $keyType = 'string';

    protected $fillable = [
        self::UUID,
        self::DESCRIPTION,
        self::DETAILS,
        self::UNIQUE_NAME,
        self::VALUE,
        self::QUANTITY,
        self::ACTIVE,
        self::CREATED_AT,
    ];
}
