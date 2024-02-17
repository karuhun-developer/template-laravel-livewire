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
                        <label class="form-label">Privacy Policy</label>
                        <textarea wire:model.live="form.privacy_policy" class="form-control" placeholder="Privacy Policy" rows="15"></textarea>
                        <x-acc-input-error for="form.privacy_policy" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Preview Privacy Policy</label>
                        <x-markdown>{{ $form->privacy_policy }}</x-markdown>
                    </div>
                </div>
            </x-acc-form>
        </div>
    </div>
</div>
