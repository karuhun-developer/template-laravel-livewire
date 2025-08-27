@props([
    'model' => null,
    'old' => null,
])

<div class="mb-3">
    @if($model instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <img src="{{ $model->temporaryUrl() }}" alt="logo" class="img-fluid">
    @elseif($old != null)
        <img src="{{ $old }}" alt="logo" class="img-fluid">
    @endif
</div>
