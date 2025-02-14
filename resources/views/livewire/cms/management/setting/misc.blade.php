<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-md-3 col-xl-2">
            @include('livewire.cms.management.setting.a-sidebar')
        </div>
        <div class="col-md-9 col-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }} Data</h5>
                    </div>
                    <x-acc-form submit="save">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Google Analytic</label>
                                <x-acc-input model="form.google_analytics" placeholder="Google Analytic" icon="fa fa-chart-line" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
