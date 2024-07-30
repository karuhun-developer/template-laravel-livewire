@props([
    'route' => '',
    'class' => 'btn btn-secondary',
    'routeParams' => [],
])
<a href="{{ route($route, $routeParams) }}" wire:navigate {!! $attributes !!} class="{{ $class }}">
    <i class="fa fa-arrow-left"></i>
    Back
</a>
