<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait WithGenerateReference
{
    /**
     * @return array{code: string, number: int}
     */
    public function generateReference(Model|Builder $model, string $prefix = '', string $suffix = '', string $field = 'ref_number'): array
    {
        $reference = $prefix;
        $latest = $model->orderBy($field, 'desc')->first();
        $latest = $latest ? $latest->{$field} : 0;

        $reference = $reference.str_pad($latest + 1, 5, '0', STR_PAD_LEFT).$suffix;

        return [
            'code' => $reference,
            'number' => $latest + 1,
        ];
    }
}
