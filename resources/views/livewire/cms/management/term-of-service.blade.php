<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-form submit="save">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Term Of Service</label>
                        <textarea wire:model.live="form.term_of_service" class="form-control" placeholder="Term Of Service" rows="15"></textarea>
                        <x-acc-input-error for="form.term_of_service" />

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
