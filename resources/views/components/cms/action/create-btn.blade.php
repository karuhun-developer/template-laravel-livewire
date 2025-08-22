@props([
    'model',
    'link',
])
@if(auth()->user()->can('create.' . $model))
    <a class="btn bg-gradient-dark btn-sm mb-0" href="{{ $link }}">
        {{ $slot }}
    </a>
@endif
