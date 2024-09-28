<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait WithGetFilterData {

    public function getDataWithFilter(Model|Builder $model, array $searchBy = [
        [
            'name' => '',
            'field' => '',
            'no_search' => true,
        ]
    ], string $orderBy = 'id', string $order = 'asc', int $paginate = 10, string $s = '') {

        $model = $model->where(function ($query) use ($s, $searchBy) {
            foreach ($searchBy as $key => $value) {
                if(!isset($value['no_search'])) {
                    $field = $value['field'];

                    if(str_contains($field, '.')) {
                        // Find the relationship and attribute parts
                        $lastDotPos = strrpos($field, '.');
                        $relation = substr($field, 0, $lastDotPos); // (relationship)
                        $relatedAttribute = substr($field, $lastDotPos + 1); // name (attribute)

                        // Relationship search
                        $query->orWhereHas($relation, function ($q) use ($relatedAttribute, $s) {
                            $q->where($relatedAttribute, 'like', "%$s%");
                        });
                    } else {
                        // Normal search
                        $query->orWhere($field, 'like', "%$s%");
                    }
                }
            }
        });

        $model = $model->orderBy($orderBy, $order);

        $model = $model->latest();

        return $model->paginate($paginate);
    }
}
