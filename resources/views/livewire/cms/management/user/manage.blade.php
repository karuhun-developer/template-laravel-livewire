<div>
    <x-acc-back :route="substr($originRoute, 0, -7)" />
    <h1 class="h3 mb-3 mt-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }}</h5>
                    </div>
                    <x-acc-form submit="save">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <x-acc-input type="select" :live="true" model="form.role">
                                    <option value="">--Select Role--</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-acc-input type="text" model="form.name" placeholder="Name" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <x-acc-input type="email" model="form.email" placeholder="Email" />
                            </div>
                        </div>
                        @if(!$isUpdate)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <x-acc-input type="password" model="form.password" placeholder="Password" />
                                </div>
                            </div>
                        @endif
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
