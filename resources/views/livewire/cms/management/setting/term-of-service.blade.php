<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>
    <div class="row">
        <div class="col-md-3 col-xl-2">
            @include('livewire.cms.management.setting.a-sidebar')
        </div>
        <div class="col-md-9 col-xl-10">
            <div class="card">
                <div class="card-body">
                    <x-acc-form submit="customSave">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Term Of Service</label>
                                <x-acc-trix-editor :model="$trix" model_name="trix" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
