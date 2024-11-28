<?php
declare(strict_types=1);

namespace App\Common\Domain\Dto;

interface SearchParamsInterface
{
    public int|null $page { get; set; }
    public int|null $perPage { get; set; }
    public string|null $columnName { get; set; }
    public string|null $columnOrder { get; set; }
}
