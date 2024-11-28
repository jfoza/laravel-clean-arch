<?php
declare(strict_types=1);

namespace App\Common\Domain\Entities;

use App\Libraries\Uuid\Uuid;

abstract class Entity
{
    public readonly string $uuid;
    protected string $currentDate { get => date('Y-m-d H:i:s'); }

    public function __construct(?string $uuid = null) {
        $this->uuid = $uuid ?? Uuid::v4();
    }
}
