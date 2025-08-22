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
            session: '{{ $type }}',
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
@endforeach
