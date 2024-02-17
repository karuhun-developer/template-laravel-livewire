@props([
    'route' => '',
])
<div x-data>
    @can('create.' . $route)
        <div class="float-end">
            <button
                class="btn btn-success"
                wire:loading.attr="disabled"
                wire:target="create"
                wire:click="create"
                @click="new bootstrap.Modal(document.getElementById('acc-modal')).show()"
            >
                <i class="align-middle" data-feather="plus-circle"></i>
                Create
            </button>
        </div>
    @endcan
</div>
