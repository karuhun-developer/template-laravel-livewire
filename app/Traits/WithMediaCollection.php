<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

trait WithMediaCollection
{
    public function saveMedia(Model $model, UploadedFile|string $file, string $collection = 'images', bool $deleteOlderMedia = true): void
    {
        if ($deleteOlderMedia) {
            $model->clearMediaCollection($collection);
        }

        $model->addMedia($file)->toMediaCollection($collection);
    }

    public function deleteMedia(Model $model, string $collection = 'images'): void
    {
        $model->clearMediaCollection($collection);
    }
}
