<!-- List session flash -->
@foreach([
    'success',
    'error',
    'warning',
    'info',
] as $type)
    @if(session()->has($type))
        <div x-data="{
            show: true,
            init() {
                $nextTick(() => {
                    window.Toast.fire({
                        icon: '{{ $type }}',
                        title: '{{ session($type) }}',
                    });
                });
            }
        }">
        </div>
    @endif
    <div x-on:toast-{{ $type }}.window="window.Toast.fire({
        icon: '{{ $type }}',
        title: $event.detail.message ?? '{{ ucfirst($type) }} message',
    });"></div>
@endforeach
