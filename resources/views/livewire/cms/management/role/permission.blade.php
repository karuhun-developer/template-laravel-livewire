<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="float-start">
                        <button class="btn btn-primary" wire:click="checkAll" wire:loading.attr="disabled">
                            <i class="fa fa-check"></i>
                            Check All
                        </button>
                        <button class="btn btn-danger" wire:click="uncheckAll" wire:loading.attr="disabled">
                            <i class="fa fa-x"></i>
                            Uncheck All
                        </button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($permissions as $route => $type)
                        <div class="col-md-12 mb-2">
                            <hr>
                            <h5>Route: {{ $route }}</h5>
                            <div class="row">
                            @foreach($type as $name => $value)
                                @php
                                    $label = explode('.', $name);
                                    $label = $label[0];
                                @endphp
                                <div class="col-md-3 mb-2">
                                    <div class="form-check form-switch" x-data="{ check: {{ $value ? 'true' : 'false' }} }" x-init="$watch('check', value => {
                                        $wire.{{ $value ? 'uncheck' : 'check' }}('{{ $name }}', '{{ $route }}');
                                    });">
										<input class="form-check-input"
                                            type="checkbox"
                                            x-model="check"
                                            wire:loading.attr="disabled" />
										<label class="form-check-label">{{ ucfirst($label) }}</label>
									</div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
