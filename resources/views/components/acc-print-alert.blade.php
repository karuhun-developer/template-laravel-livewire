@props([
    'session' => 'success',
    'type' => 'success',
])
@if(session($session))
    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst($type) }}!</strong> {{ session($session) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
