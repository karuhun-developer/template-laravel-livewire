@props([
    'model' => null,
    'old' => null,
    'icon' => 'fa-file-pdf',
    'label' => 'View PDF',
])

<div class="mb-3">
    @if($model instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
        <a href="{{ $model->temporaryUrl() }}" target="_blank" class="btn btn-primary">
            <i class="fa-solid {{ $icon }}"></i> {{ $label }}
        </a>
    @elseif($old != null)
        <a href="{{ $old }}" target="_blank" class="btn btn-primary">
            <i class="fa-solid {{ $icon }}"></i> {{ $label }}
        </a>
    @endif
</div>
