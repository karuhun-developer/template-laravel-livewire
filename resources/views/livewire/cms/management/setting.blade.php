<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-form submit="saveWithUpload">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Google Analytic</label>
                        <input type="text" wire:model="form.google_analytics" class="form-control" placeholder="Google Analytic">
                        <x-acc-input-error for="form.google_analytics" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">App Name</label>
                        <input type="text" wire:model="form.name" class="form-control" placeholder="App Name">
                        <x-acc-input-error for="form.name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">App Logo</label>
                        <x-acc-image-preview :image="$logo" :form_image="asset('storage/settings/' . $form->old_data->logo)"  />
                        <input type="file" wire:model="logo" class="form-control">
                        <x-acc-input-error for="logo" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">App Icon</label>
                        <x-acc-image-preview :image="$favicon" :form_image="asset('storage/settings/' . $form->old_data->favicon)"  />
                        <input type="file" wire:model="favicon" class="form-control">
                        <x-acc-input-error for="favicon" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" wire:model="form.email" class="form-control" placeholder="Email">
                        <x-acc-input-error for="form.email" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="number" wire:model="form.phone" class="form-control" placeholder="Phone">
                        <x-acc-input-error for="form.phone" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea wire:model="form.address" class="form-control" placeholder="Address"></textarea>
                        <x-acc-input-error for="form.address" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">About Us</label>
                        <textarea wire:model="form.about" class="form-control" placeholder="About Us"></textarea>
                        <x-acc-input-error for="form.about" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Vision</label>
                        <textarea wire:model.live="form.vision" class="form-control" placeholder="Vision" rows="5"></textarea>
                        <x-acc-input-error for="form.vision" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Preview Vision</label>
                        <x-markdown>{{ $form->vision }}</x-markdown>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Mission</label>
                        <textarea id="mission" wire:model="form.mission" class="form-control" placeholder="Mission" rows="5"></textarea>
                        <x-acc-input-error for="form.mission" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Preview Mission</label>
                        <x-markdown>{{ $form->mission }}</x-markdown>
                    </div>
                </div>

                {{-- Meta Tag --}}
                <div class="col-md-12">
                    <hr>
                    <div class="text-center">
                        <h1 class="h-2 mb-3">Meta Tag</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Author</label>
                        <input type="text" wire:model="form.author" class="form-control" placeholder="Author">
                        <x-acc-input-error for="form.author" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Description</label>
                        <textarea wire:model="form.description" class="form-control" placeholder="Description"></textarea>
                        <x-acc-input-error for="form.description" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Keywords</label>
                        <textarea wire:model="form.keywords" class="form-control" placeholder="Keywords"></textarea>
                        <x-acc-input-error for="form.keywords" />
                    </div>
                </div>

                {{-- Open Graph --}}
                <div class="col-md-12">
                    <hr>
                    <div class="text-center">
                        <h1 class="h-2 mb-3">Open Graph Tag</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Site name</label>
                        <input type="text" wire:model="form.opengraph.site_name" class="form-control" placeholder="Site Name">
                        <x-acc-input-error for="form.opengraph.site_name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model="form.opengraph.title" class="form-control" placeholder="Title">
                        <x-acc-input-error for="form.opengraph.title" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" wire:model="form.opengraph.type" class="form-control" placeholder="Type">
                        <x-acc-input-error for="form.opengraph.type" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <x-acc-image-preview :image="$opengraph_image" :form_image="asset('storage/settings/' . $form->old_data->opengraph_image)"  />
                        <input type="file" wire:model="opengraph_image" class="form-control">
                        <x-acc-input-error for="opengraph_image" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" wire:model="form.opengraph.url" class="form-control" placeholder="URL">
                        <x-acc-input-error for="form.opengraph.url" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="form.opengraph.description" class="form-control" placeholder="Description"></textarea>
                        <x-acc-input-error for="form.opengraph.description" />
                    </div>
                </div>

                {{-- Dulbin Core --}}
                <div class="col-md-12">
                    <hr>
                    <div class="text-center">
                        <h1 class="h-2 mb-3">Dulbin Core Tag</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model="form.dulbincore.title" class="form-control" placeholder="Title">
                        <x-acc-input-error for="form.dulbincore.title" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Publisher</label>
                        <input type="text" wire:model="form.dulbincore.publisher" class="form-control" placeholder="Publisher">
                        <x-acc-input-error for="form.dulbincore.publisher" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Publisher URL</label>
                        <input type="text" wire:model="form.dulbincore.publisher_url" class="form-control" placeholder="Publisher URL">
                        <x-acc-input-error for="form.dulbincore.publisher_url" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="form.dulbincore.description" class="form-control" placeholder="Description"></textarea>
                        <x-acc-input-error for="form.dulbincore.description" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Creator</label>
                        <input type="text" wire:model="form.dulbincore.creator_name" class="form-control" placeholder="Creator">
                        <x-acc-input-error for="form.dulbincore.creator_name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" wire:model="form.dulbincore.subject" class="form-control" placeholder="Subject">
                        <x-acc-input-error for="form.dulbincore.subject" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Language</label>
                        <input type="text" wire:model="form.dulbincore.language" class="form-control" placeholder="Language">
                        <x-acc-input-error for="form.dulbincore.language" />
                    </div>
                </div>
            </x-acc-form>
        </div>
    </div>
</div>
