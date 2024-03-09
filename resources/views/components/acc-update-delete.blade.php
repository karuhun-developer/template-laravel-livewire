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
    {{ $slot ?? '' }}
    @if($edit)
        @can('update.' . $originRoute)
            <button
                class="btn btn-warning"
                wire:click="{{ $editFunction }}('{{ $id }}')"
                @click="new bootstrap.Modal(document.getElementById('{{ $modal }}')).show()"
            >
                <i class="align-middle" data-feather="edit"></i>
            </button>
        @endcan
    @endif
    @if($delete)
        @can('delete.' . $originRoute)
            <button
                class="btn btn-danger"
                wire:click="{{ $deleteFunction }}('{{ $id }}')"
            >
                <i class="align-middle" data-feather="trash"></i>
            </button>
        @endcan
    @endif
</td>
