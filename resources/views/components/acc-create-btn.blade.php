@props([
    'route' => '',
    'createFunction' => 'create',
])
<div x-data>
    @can('create.' . $route)
        <div class="float-end">
            <button
                class="btn btn-success"
                wire:loading.attr="disabled"
                wire:target="{{ $createFunction }}"
                wire:click="{{ $createFunction }}"
                @click="new bootstrap.Modal(document.getElementById('acc-modal')).show()"
            >
                <i class="align-middle" data-feather="plus-circle"></i>
                Create
            </button>
        </div>
    @endcan
</div>
