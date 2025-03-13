<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait WithGenerateReference {

    public function generateReference(Model|Builder $model, string $prefix = 'GGWP', $field = 'ref_number') : array {
        $reference = $prefix . '-';
        $latest = $model->latest()->first();
        $latest = $latest ? $latest->{$field} : 0;

        $reference = $reference . str_pad($latest + 1, 5, "0", STR_PAD_LEFT);

        return [
            'code' => $reference,
            'number' => $latest + 1
        ];
    }
}
