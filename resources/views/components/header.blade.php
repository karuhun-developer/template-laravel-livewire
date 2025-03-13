@props([
    'preTitle' => null,
    'title' => null,
])
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                @if ($preTitle)
                    <div class="page-pretitle">
                        {{ $preTitle }}
                    </div>
                @endif
                <!-- Page title -->
                @if($title)
                    <h2 class="page-title">
                        {{ $title }}
                    </h2>
                @endif
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url({{ asset('img/person.jpg') }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>
                                {{ auth()->user()->name }}
                            </div>
                            <div class="mt-1 small text-secondary">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span class="ms-2">
                                My Profile
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" x-on:click.prevent="
                            window.Swal.fire({
                                title: 'Are you sure?',
                                text: '',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch('{{ route('logout') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(() => {
                                        window.location.href = '/login'
                                    })
                                }
                            })
                        ">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ms-2">
                                Logout
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
