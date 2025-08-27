@props([
    'model' => null,
    'old' => null,
])


<div class="mb-3">
    @if($model instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <audio controls>
            <source src="{{ $model->temporaryUrl() }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @elseif($old != null)
        <audio controls>
            <source src="{{ $old }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif
</div>
