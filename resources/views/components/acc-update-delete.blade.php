@props([
    'id' => 0,
    'modal' => 'acc-modal',
    'edit' => true,
    'delete' => true,
    'editFunction' => 'edit',
    'deleteFunction' => 'confirmDelete',
    'originRoute' => '',
])

<td>
    {{ $slotOutside ?? '' }}
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="update-delete-dropdown-{{ $id }}" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="update-delete-dropdown-{{ $id }}">
            @if($edit)
                @can('update.' . $originRoute)
                    <li>
                        <button
                            class="dropdown-item"
                            wire:click="{{ $editFunction }}('{{ $id }}')"
                        >
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                    </li>
                @endcan
            @endif
            @if($delete)
                @can('delete.' . $originRoute)
                    <li>
                        <button
                            class="dropdown-item"
                            wire:click="{{ $deleteFunction }}('{{ $id }}')"
                        >
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </li>
                @endcan
            @endif
            {{ $slot ?? '' }}
        </ul>
    </div>
</td>
