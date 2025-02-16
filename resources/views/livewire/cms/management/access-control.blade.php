<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" x-data>
                    <div class="mb-3">
                        <label class="form-label fw-bold">API KEY</label>
                        <p x-ref="apikey">{{ $apikey }}</p>
                        <button class="btn btn-primary" x-on:click="navigator.clipboard.writeText($refs.apikey.innerText);">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
