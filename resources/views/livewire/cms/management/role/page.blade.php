<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Role;

new class extends BaseComponent {
    public string $title = 'Role Management';

    // Pagination and Search
    public array $searchBy = [
        [
            'name' => 'Name',
            'field' => 'name',
        ],
        [
            'name' => 'Created At',
            'field' => 'created_at',
        ],
    ];
    public string $search = '';
    public int $paginate = 1;
    public string $orderBy = 'created_at';
    public string $order = 'desc';

    public function with() {
        return [
            'data' => $this->getDataWithFilter(
                model: new Role,
                searchBy: $this->searchBy,
                orderBy: $this->orderBy,
                order: $this->order,
                paginate: $this->paginate,
                s: $this->search,
            ),
        ];
    }
}; ?>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            {{ $title }}
                        </h6>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <x-cms.livewire.loop-th :$searchBy :$orderBy :$order />
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td class="align-middle">
                                            <h6 class="text-sm text-secondary">
                                                {{ $d->name }}
                                            </h6>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="text-sm text-secondary">
                                                {{ $d->created_at->format('d F Y') }}
                                            </h6>
                                        </td>
                                        <td class="align-middle">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center text-secondary">
                                            <h6 class="mb-0 text-sm">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                No data found.
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
