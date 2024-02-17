@props([
    'image' => null,
    'form_image' => null,
])

<div class="mb-3">
    @if($image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <img src="{{ $image->temporaryUrl() }}" alt="logo" class="img-fluid">
    @elseif($form_image !== null)
        <img src="{{ $form_image }}" alt="logo" class="img-fluid">
    @endif
</div>
