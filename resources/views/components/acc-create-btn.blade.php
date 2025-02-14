@props([
    'route' => '',
    'createClass' => 'btn btn-success',
    'createClick' => 'create',
    'createIcon' => 'fa fa-plus-circle',
    'createText' => 'Create',
])
<div>
    @can('create.' . $route)
        <div class="float-end">
            <button
                class="{{ $createClass }}"
                wire:click="{{ $createClick }}"
            >
                <i class="{{ $createIcon }}"></i>
                <span class="ms-2">
                    {{ $createText }}
                </span>
            </button>
        </div>
    @endcan
</div>
