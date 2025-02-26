<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait WithGetFilterDataApi {

    public function getDataWithFilter(
        Model|Builder $model,
        array $searchBy = [],
        string $searchBySpecific = '',
        string $orderBy = 'id',
        string $order = 'asc',
        int $paginate = 10,
        string $s = ''
    ) {

        $model = $model->where(function ($query) use ($s, $searchBy, $searchBySpecific) {
            if($searchBySpecific) {
                $query->where($searchBySpecific, 'like', "%$s%");
            } else {
                foreach ($searchBy as $value) {
                    $query->orWhere($value, 'like', "%$s%");
                }
            }
        });

        $model = $model->orderBy($orderBy, $order);

        // $model = $model->latest();

        return $model->paginate($paginate);
    }
}
