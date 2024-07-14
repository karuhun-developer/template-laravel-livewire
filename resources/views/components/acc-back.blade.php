@props([
    'route' => '',
    'class' => 'btn btn-secondary',
    'routeParams' => [],
])
<a href="{{ route($route, $routeParams) }}" wire:navigate {!! $attributes !!} class="{{ $class }}">
    <i class="align-middle" data-feather="arrow-left"></i>
    Back
</a>
