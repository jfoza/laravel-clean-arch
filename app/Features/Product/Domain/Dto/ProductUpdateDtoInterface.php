<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Dto;

interface ProductUpdateDtoInterface extends ProductCreateDtoInterface
{
    public bool $active { get; set; }
}
