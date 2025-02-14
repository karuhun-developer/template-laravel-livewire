@props([
    'route' => '',
    'class' => 'btn btn-secondary mb-3',
    'routeParams' => [],
])
<a href="{{ route($route, $routeParams) }}" wire:navigate {!! $attributes !!} class="{{ $class }}">
    <i class="fa fa-arrow-left"></i>
    <span class="ms-2">
        Back
    </span>
</a>
