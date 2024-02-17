@foreach($searchBy as $th)
    @if(!isset($th['hide']))
        <x-acc-th :orderby="$orderBy" :order="$order" :field="$th['field']">
            {{ $th['name'] }}
        </x-acc-th>
    @endif
@endforeach
