<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

trait WithGetFilterDataApi
{
    /**
     * @param  array<int, string>  $searchBy
     */
    public function getDataWithFilter(
        Model|Builder $model,
        array $searchBy = [],
        string $searchBySpecific = '',
        string $orderBy = 'id',
        string $order = 'asc',
        int $paginate = 10,
        string $s = '',
        string $paginateFunction = 'fastPaginate',
    ): LengthAwarePaginator {
        $model = $model->where(function ($query) use ($s, $searchBy, $searchBySpecific) {
            if ($searchBySpecific) {
                $query->where($searchBySpecific, 'like', "%$s%");
            } else {
                foreach ($searchBy as $value) {
                    $query->orWhere($value, 'like', "%$s%");
                }
            }
        });

        $model = $model->orderBy($orderBy, $order);

        // $model = $model->latest();

        return $model->{$paginateFunction}($paginate);
    }
}
