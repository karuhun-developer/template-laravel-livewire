@props([
    'route' => '',
    'createClick' => 'create',
])
<div>
    @can('create.' . $route)
        <div class="float-end">
            <button
                class="btn btn-success"
                wire:click="{{ $createClick }}"
            >
                <i class="fa fa-plus-circle"></i>
                Create
            </button>
        </div>
    @endcan
</div>
