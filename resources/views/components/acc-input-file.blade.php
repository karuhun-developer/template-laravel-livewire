@props([
    'model' => null,
    'class' => 'form-control',
    'imageIttr' => 1,
])
<x-acc-upload-progress>
    <input type="file" wire:model="{{ $model }}" class="{{ $class }}" id="{{ $imageIttr }}">
</x-acc-upload-progress>
