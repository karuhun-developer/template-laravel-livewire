@props([
    'model' => null,
    'old' => null,
])

<div class="mb-3">
    @if($model instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <video src="{{ $model->temporaryUrl() }}" alt="logo" class="img-fluid" controls></video>
    @elseif($old !== null)
        <video src="{{ $old }}" alt="logo" class="img-fluid" controls></video>
    @endif
</div>
