@props([
    'model',
    'link',
])
@if(auth()->user()->can('update.' . $model))
    <a class="btn btn-link text-dark text-gradient mb-0" href="{{ $link }}">
        {{ $slot }}
    </a>
@endif
