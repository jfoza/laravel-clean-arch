<?php
declare(strict_types=1);

namespace App\Libraries\LaravelInjectable\Src;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Inject
{
    public function __construct(public string $class)
    {
    }
}
