@props([
    'isCreate' => true,
    'isSearch' => true,
    'isPaginate' => true,
    'originRoute' => '',
    'createFunction' => 'create'
])

<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="float-start">
                @if($isCreate)
                    <x-acc-create-btn
                        :route="$originRoute"
                        :$createFunction
                    />
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        @if($isPaginate)
            <div class="col-md-{{ $isSearch ? '6' : '12' }}">
                <select class="form-control" wire:model.live.debounce.750="paginate">
                    <option value="10">10 Records Per Page</option>
                    <option value="25">25 Records Per Page</option>
                    <option value="50">50 Records Per Page</option>
                    <option value="100">100 Records Per Page</option>
                </select>
            </div>
        @endif
        @if($isSearch)
            <div class="col-md-{{ $isPaginate ? '6' : '12' }}">
                <x-acc-search />
            </div>
        @endif
        {{ $slot->isEmpty() ? '' : $slot }}
    </div>
</div>
