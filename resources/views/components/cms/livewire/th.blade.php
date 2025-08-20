@props([
    'orderby',
    'order',
    'field',
])
<th wire:click="changeOrder('{{ $field }}')" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer">
    @if($orderby == $field)
        @if($order == 'asc')
            <i class="fa fa-sort-amount-down"></i>
        @else
            <i class="fa fa-sort-amount-up"></i>
        @endif
    @endif
    {{ $slot ?? '' }}
</th>
