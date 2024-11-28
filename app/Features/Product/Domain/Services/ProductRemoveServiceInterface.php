<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Services;

interface ProductRemoveServiceInterface
{
    public function execute(string $uuid): void;
}
