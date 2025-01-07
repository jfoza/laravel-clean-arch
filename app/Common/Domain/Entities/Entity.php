<?php
declare(strict_types=1);

namespace App\Common\Domain\Entities;

use App\Common\Domain\ValueObjects\UniqueEntityId;

abstract class Entity
{
    private readonly UniqueEntityId $uniqueEntityId;

    public function __construct(?UniqueEntityId $uniqueEntityId = null) {
        $this->uniqueEntityId = $uniqueEntityId ?? UniqueEntityId::create();
    }

    public string $uuid { get => $this->uniqueEntityId->toValue(); }
}
