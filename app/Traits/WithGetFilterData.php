<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

trait WithGetFilterData
{
    /**
     * @param  array<int, array{name?: string, field?: string, no_search?: bool, hide?: bool}>  $searchBy
     */
    public function getDataWithFilter(
        Model|Builder $model,
        array $searchBy = [
            [
                'name' => '',
                'field' => '',
                'no_search' => true,
                'hide' => false,
            ],
        ],
        string $orderBy = 'id',
        string $order = 'desc',
        int $paginate = 10,
        string $s = '',
        string $paginateFunction = 'fastPaginate',
    ): LengthAwarePaginator {
        $model = $model->when(! empty($s) && ! empty($searchBy), function ($query) use ($s, $searchBy) {
            $query->where(function ($query) use ($s, $searchBy) {
                foreach ($searchBy as $value) {
                    if (isset($value['field']) && (! isset($value['no_search']) || $value['no_search'] !== true)) {
                        $field = $value['field'];
                        $query->orWhere($field, 'like', "%{$s}%");
                    }
                }
            });
        });

        $model = $model->orderBy($orderBy, $order);

        return $model->{$paginateFunction}($paginate);
    }
}
