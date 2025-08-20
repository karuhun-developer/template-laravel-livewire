@props([
    'searchBy',
    'orderBy',
    'order',
])
@foreach($searchBy as $th)
    @if(!isset($th['hide']))
        <x-cms.livewire.th :orderby="$orderBy" :order="$order" :field="$th['field']">
            {{ $th['name'] }}
        </x-cms.livewire.th>
    @endif
@endforeach
