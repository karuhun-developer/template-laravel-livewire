@props(['orderby', 'order', 'field'])

<th x-data x-on:click="$wire.changeOrder('{{$field}}')" style="cursor: pointer">
    @if($orderby == $field)
        @if($order == 'asc')
            <i class="align-middle" data-feather="chevrons-down"></i>
        @else
            <i class="align-middle" data-feather="chevrons-up"></i>
        @endif
    @endif
    {{ $slot->isEmpty() ? 'th' : $slot }}
</th>

