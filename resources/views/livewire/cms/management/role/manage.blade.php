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
                                <label class="form-label">Name</label>
                                <x-acc-input type="text" model="form.name" placeholder="Name" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
