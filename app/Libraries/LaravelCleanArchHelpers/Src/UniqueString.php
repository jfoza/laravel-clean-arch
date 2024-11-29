<?php
declare(strict_types=1);

namespace App\Libraries\LaravelCleanArchHelpers\Src;

class UniqueString
{
    public static function generate(string $value): string
    {
        $value = strtolower(Helpers::removeAccents($value));
        $value = preg_replace('/[^a-z0-9\s]/', '', $value);
        return preg_replace('/\s+/', '-', trim($value));
    }
}
