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
                <i class="align-middle" data-feather="plus-circle"></i>
                Create
            </button>
        </div>
    @endcan
</div>
