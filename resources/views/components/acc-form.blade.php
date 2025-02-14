@props(['submit', 'reset' => 'resetAll'])

<div {{ $attributes->merge(['class' => 'container mt-2']) }}>
    <form wire:submit="{{ $submit }}">
        <div class="container">
            <div class="row">
                {{ $slot }}
            </div>
        </div>

        @if (isset($actions))
            <div class="row">
                {{ $actions }}
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="float-end">
                        <button
                            class="btn btn-warning"
                            wire:loading.attr="disabled"
                            wire:click="{{ $reset }}"
                            type="button">
                            <i class="fa fa-redo"></i>
                            <span class="ms-2">
                                Reset
                            </span>
                        </button>
                        <button
                            class="btn btn-success"
                            wire:loading.attr="disabled"
                            wire:target="{{ $submit }}"
                            type="submit">
                            <i class="fa fa-save"></i>
                            <span class="ms-2">
                                Save
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
