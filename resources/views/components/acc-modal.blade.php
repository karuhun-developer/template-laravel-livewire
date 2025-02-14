@props([
    'id' => 'acc-modal',
    'title' => 'Title',
    'isModaOpen' => false,
    'closeModalFunction' => 'closeModal',
    'size' => 'md',
])

<div class="{{ $isModaOpen ? 'd-block' : 'd-none' }}">
    <div class="modal fade show" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true" wire:ignore.self style="display: block">
        <div class="modal-dialog modal-{{ $size }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}-label">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="{{ $closeModalFunction }}">
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
