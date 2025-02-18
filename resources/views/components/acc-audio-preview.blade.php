@props([
    'audio' => null,
    'form_audio' => null,
])

<div class="mb-3">
    @if($audio instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <audio controls>
            <source src="{{ $audio->temporaryUrl() }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @elseif($form_audio != null)
        <audio controls>
            <source src="{{ $form_audio }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif
</div>
