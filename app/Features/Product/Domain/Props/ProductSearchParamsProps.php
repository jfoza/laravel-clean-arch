<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Props;

class ProductSearchParamsProps
{
    public ?string $description;
    public ?string $userUuid;
    public ?bool $active;
}
