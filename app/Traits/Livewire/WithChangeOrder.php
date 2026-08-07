<?php

declare(strict_types=1);

namespace App\Traits\Livewire;

trait WithChangeOrder
{
    public function changeOrder(string $paginationOrderBy): void
    {
        if ($this->paginationOrderBy == $paginationOrderBy) {
            $this->paginationOrder = $this->paginationOrder == 'desc' ? 'asc' : 'desc';
        }

        $this->paginationOrderBy = $paginationOrderBy;
    }
}
