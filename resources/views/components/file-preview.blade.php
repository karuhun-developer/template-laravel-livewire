@props([
    'type' => 'image',
    'file' => null,
    'form_file' => null,
])

<div class="mb-3 max-w-[95%]">
    @if ($type === 'image')
        @if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <img src="{{ $file->temporaryUrl() }}" alt="logo" class="h-auto w-90 object-contain" loading="lazy" />
        @elseif ($form_file != null)
            <img src="{{ $form_file }}" alt="logo" class="h-auto w-90 object-contain" loading="lazy" />
        @endif

    @elseif ($type === 'video')
        @if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <video controls class="h-auto w-90 object-contain" src="{{ $file->temporaryUrl() }}">
                Your browser does not support the video tag.
            </video>
        @elseif ($form_file != null)
            <video controls class="h-auto w-90 object-contain" src="{{ $form_file }}">
                Your browser does not support the video tag.
            </video>
        @endif

    @elseif ($type === 'audio')
        @if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <audio controls class="w-90" src="{{ $file->temporaryUrl() }}">
                Your browser does not support the audio element.
            </audio>
        @elseif ($form_file != null)
            <audio controls class="w-90" src="{{ $form_file }}">Your browser does not support the audio element.</audio>
        @endif

    @elseif ($type === 'pdf')
        @if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <iframe src="{{ $file->temporaryUrl() }}" class="h-96 w-90" frameborder="0"></iframe>
        @elseif ($form_file != null)
            <iframe src="{{ $form_file }}" class="h-96 w-90" frameborder="0"></iframe>
        @endif

    @else
        @if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <div class="rounded border border-gray-300 bg-gray-50 p-4">
                <p class="text-gray-700">File Name: {{ $file->getClientOriginalName() }}</p>
                <p class="text-gray-700">File Size: {{ number_format($file->getSize() / 1024, 2) }} KB</p>
            </div>
        @elseif ($form_file != null)
            <div class="rounded border border-gray-300 bg-gray-50 p-4">
                <p class="text-gray-700">
                    File: <a href="{{ $form_file }}" target="_blank" class="text-blue-600 underline">Download</a>
                </p>
            </div>
        @endif

    @endif
</div>
