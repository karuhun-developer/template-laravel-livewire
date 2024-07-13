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
                        <button class="btn btn-primary" wire:click="checkAll">
                            <i class="align-middle" data-feather="check"></i>
                            Check All
                        </button>
                        <button class="btn btn-danger" wire:click="uncheckAll" >
                            <i class="align-middle" data-feather="x"></i>
                            Uncheck All
                        </button>
                    </div>
                    <div class="col-md-12 mt-2" wire:loading>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
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

                                    // Button class
                                    $class = 'btn-danger';
                                    $icon = 'x';
                                    $wire = 'check';
                                    if ($value) {
                                        $class = 'btn-success';
                                        $icon = 'check';
                                        $wire = 'uncheck';
                                    }
                                @endphp
                                <div class="col-md-3 mb-2">
                                    <div class="form-check">
                                        <button class="btn {{ $class }}" wire:click="{{ $wire }}('{{ $name }}', '{{ $route }}')">
                                            <i class="align-middle" data-feather="{{ $icon }}"></i>
                                        </button>
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
