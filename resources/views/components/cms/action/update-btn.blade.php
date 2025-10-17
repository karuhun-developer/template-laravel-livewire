@props([
    'modelInstance',
    'link',
])
@if(auth()->user()->can('update.' . $modelInstance))
    <a class="btn btn-link text-dark text-gradient mb-0" href="{{ $link }}" {!! $attributes !!}>
        {{ $slot }}
    </a>
@endif
