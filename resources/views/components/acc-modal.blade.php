@props([
    'title' => 'Title',
    'modal' => 'acc-modal',
    'size' => 'md',
])

<div x-data="{ open: @entangle('modals.'.$modal) }" style="display: none" x-show.important="open" x-on:keydown.escape.window="open = false">
    <div class="modal fade show mt-5" id="{{ $modal }}" tabindex="-1" aria-labelledby="{{ $modal }}-label" aria-hidden="true" wire:ignore.self style="display: block">
        <div class="modal-dialog modal-{{ $size }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modal }}-label">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" x-on:click="open = false">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                @if (isset($actions))
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="acc-modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button> --}}
                        <div class="text-center">
                            {{ $actions }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</div>
