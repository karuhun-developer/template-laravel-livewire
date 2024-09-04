<x-acc-with-alert>
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
                    <x-acc-form submit="save">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Term Of Service</label>
                                <x-acc-input type="textarea" :live="true" model="form.term_of_service" placeholder="Term Of Service" rows="15" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Preview Term Of Service</label>
                                <x-markdown>{{ $form->term_of_service }}</x-markdown>
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</x-acc-with-alert>
