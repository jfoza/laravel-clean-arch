<?php
declare(strict_types=1);

namespace App\Common\Application\Dto;

trait SearchParams
{
    const int DEFAULT_PER_PAGE = 100;
    const string DEFAULT_COLUMN_NAME = 'createdAt';
    const string DEFAULT_COLUMN_ORDER = 'DESC';

    public int|null $page {
        get => $this->page;
        set => $this->page = $value ?: null;
    }

    public int|null $perPage {
        get => $this->perPage;
        set => $this->perPage = $value ?: self::DEFAULT_PER_PAGE;
    }

    public string|null $columnName {
        get => $this->columnName;
        set => $this->columnName = $value ?: self::DEFAULT_COLUMN_NAME;
    }

    public string|null $columnOrder {
        get => $this->columnOrder;
        set => $this->columnOrder = $value ?: self::DEFAULT_COLUMN_ORDER;
    }
}
