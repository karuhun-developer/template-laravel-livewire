@props([
    'modelInstance',
    'link',
])
@if(auth()->user()->can('create.' . $modelInstance))
    <a class="btn bg-gradient-dark btn-sm mb-0" href="{{ $link }}" {!! $attributes !!}>
        {{ $slot }}
    </a>
@endif
