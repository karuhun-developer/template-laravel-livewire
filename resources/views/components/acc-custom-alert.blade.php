@props([
    'session',
    'type' => 'success',
    'message' => null,
])
@if(session()->has($session))
    <div x-data="{
        show: true,
        message: '{{ $message ?? session($session) }}',
        init() {
            $nextTick(() => {
                window.Toast.fire({
                    icon: '{{ $type }}',
                    title: this.message,
                });
            });
        }
    }">
    </div>
@endif
