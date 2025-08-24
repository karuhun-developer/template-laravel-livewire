@props([
    'modelInstance',
    'dispatch' => 'confirm',
    'function' => 'delete',
    'id',
])
@if(auth()->user()->can('update.' . $modelInstance))
    <button class="btn btn-link text-danger text-gradient mb-0" x-on:click="$wire.dispatch('{{ $dispatch }}', {
        function: '{{ $function }}',
        id: '{{ $id }}',
    })">
        {{ $slot }}
    </button>
@endif
