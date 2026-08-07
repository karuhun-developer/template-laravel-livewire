<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait WithSaveFile
{
    public function saveFile(?UploadedFile $file, string $path = 'file', string $base_file_name = 'file'): string|false
    {
        // Set base file name
        $base_file_name = $base_file_name.'_'.date('d-m-Y').'_';

        // If file is not exist
        if (! $file) {
            return false;
        }

        $filename = $base_file_name.uniqid().'.'.$file->extension();
        $file->storeAs($path, $filename);

        return $path.'/'.$filename;
    }
}
