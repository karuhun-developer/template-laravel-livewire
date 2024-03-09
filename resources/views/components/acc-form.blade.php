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
                            type="reset">
                            <i class="align-middle" data-feather="refresh-ccw"></i>
                            Reset
                        </button>
                        <button
                            class="btn btn-success"
                            wire:loading.attr="disabled"
                            wire:target="{{ $submit }}"
                            type="submit">
                            <i class="align-middle" data-feather="save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
