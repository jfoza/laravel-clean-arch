<?php
declare(strict_types=1);

namespace App\Libraries\Uuid;

use Ramsey\Uuid\Uuid as UuidAlias;

abstract class Uuid extends UuidAlias
{
    public static function isValid(string|null $uuid): bool
    {
        if(is_null($uuid))
        {
            return false;
        }

        return self::getFactory()->getValidator()->validate($uuid);
    }

    public static function v4(): string
    {
        return UuidAlias::uuid4()->toString();
    }
}
