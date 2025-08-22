@props([
    'permission' => null,
    'class' => 'btn btn-link text-info text-gradient mb-0',
    'type' => 'a', // 'a' or 'button'
])
<!-- Don't check permission -->
@if($permission === null || auth()->user()->can($permission))
    <{{ $type }}
        class="{{ $class }}"
        {!! $attributes !!}>
        {{ $slot ?? '' }}
    </{{ $type }}>
@endif
