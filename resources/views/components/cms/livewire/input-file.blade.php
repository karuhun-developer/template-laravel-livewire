@props([
    'model' => null,
    'class' => 'form-control',
    'imageIttr' => 1,
])
<x-cms.livewire.upload-progress>
    <input type="file" wire:model="{{ $model }}" class="{{ $class }}" id="{{ $imageIttr }}" {{ $attributes ?? '' }}>
</x-cms.livewire.upload-progress>
<x-acc-input-error for="{{ $model }}" />
