@props([
    'id' => 'acc-modal',
    'title' => 'Title',
])

<div>
    <div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}-label">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="acc-modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button> --}}
                    @if (isset($actions))
                        <div class="text-center">
                            {{ $actions }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
