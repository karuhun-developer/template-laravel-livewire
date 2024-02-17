@props([
    'video' => null,
    'form_video' => null,
])

<div class="mb-3">
    @if($video instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <video src="{{ $video->temporaryUrl() }}" alt="logo" class="img-fluid" controls></video>
    @elseif($form_video !== null)
        <video src="{{ $form_video }}" alt="logo" class="img-fluid" controls></video>
    @endif
</div>
