@props([
    'pdf' => null,
    'form_pdf' => null,
])

<div class="mb-3">
    @if($pdf instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <a href="{{ $pdf->temporaryUrl() }}" target="_blank" class="btn btn-primary">
            <i class="fa-solid fa-file-pdf"></i> View PDF
        </a>
    @elseif($form_pdf != null)
        <a href="{{ $form_pdf }}" target="_blank" class="btn btn-primary">
            <i class="fa-solid fa-file-pdf"></i> View PDF
        </a>
    @endif
</div>
