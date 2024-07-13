@props([
    'route' => '',
    'class' => 'btn btn-secondary',
])
<a href="{{ route($route) }}" wire:navigate {!! $attributes !!} class="{{ $class }}">
    <i class="align-middle" data-feather="arrow-left"></i>
    Back
</a>
