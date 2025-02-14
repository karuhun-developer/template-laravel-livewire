@props([
    'id' => 0,
    'modal' => 'acc-modal',
    'edit' => true,
    'delete' => true,
    'text' => 'Actions',
    'editClick' => 'edit',
    'editIcon' => 'fa fa-pencil',
    'editText' => 'Edit',
    'deleteClick' => 'confirmDelete',
    'deleteIcon' => 'fa fa-trash',
    'deleteText' => 'Delete',
    'originRoute' => '',
])

<td>
    {{ $slotOutside ?? '' }}
    <div class="dropdown">
        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $text }}
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            {{-- Edit button --}}
            @if($edit)
                @can('update.' . $originRoute)
                    <a class="dropdown-item"
                        wire:click="{{ $editClick }}('{{ $id }}')">
                        <i class="{{ $editIcon }}"></i>
                        <span class="ms-2">
                            {{ $editText }}
                        </span>
                    </a>
                @endcan
            @endif
            {{-- Delete button --}}
            @if($delete)
                @can('delete.' . $originRoute)
                    <a class="dropdown-item"
                        wire:click="{{ $deleteClick }}('{{ $id }}')">
                        <i class="{{ $deleteIcon }}"></i>
                        <span class="ms-2">
                            {{ $deleteText }}
                        </span>
                    </a>
                @endcan
            @endif
            {{ $slot ?? '' }}
        </div>
    </div>
    {{ $slotInside ?? '' }}
</td>
