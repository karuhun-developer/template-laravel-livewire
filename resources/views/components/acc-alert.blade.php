@props([
    'session' => 'success', // session name
    'type' => 'success', // info, success, warning, error
])

@if(session($session))
    <div x-data="{}" x-init="$wire.dispatch('alert', {
        type: '{{ $type }}',
        message: '{{ session($session) }}',
    })">
    </div>
@endif

