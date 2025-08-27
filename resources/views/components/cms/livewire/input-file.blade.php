@props([
    'model' => null,
    'class' => 'form-control form-control-sms',
    'imageIttr' => 1,
])
<x-cms.livewire.upload-progress>
    <div class="border rounded">
        <input type="file" wire:model="{{ $model }}" class="{{ $class }}" id="{{ $imageIttr }}" {{ $attributes ?? '' }}>
    </div>
</x-cms.livewire.upload-progress>
<x-acc-input-error for="{{ $model }}" />
