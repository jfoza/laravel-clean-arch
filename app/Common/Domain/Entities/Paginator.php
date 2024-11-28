<?php

namespace App\Common\Domain\Entities;

class Paginator
{
    public function __construct(
        public int $currentPage,
        public array $data,
        public int $from,
        public int $lastPage,
        public int $perPage,
        public int $total,
        public int $to,
    )
    {}

    public static function create(
        int $currentPage,
        array $data,
        int $from,
        int $lastPage,
        int $perPage,
        int $total,
        int $to,
    ): Paginator
    {
        return new self($currentPage, $data, $from, $lastPage, $perPage, $total, $to);
    }
}
