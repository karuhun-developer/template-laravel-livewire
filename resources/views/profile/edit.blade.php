<x-layouts.app>
    <div>
        <x-slot:page-title>
            Profile
        </x-slot:page-title>
        <x-acc-back route="cms.dashboard" />
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="col-md-12">
                            @include('profile.partials.update-password-form')
                        </div>
                        {{-- <div class="col-md-12">
                            @include('profile.partials.delete-user-form')
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
