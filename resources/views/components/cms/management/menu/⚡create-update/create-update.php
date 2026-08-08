<?php

declare(strict_types=1);

use App\Actions\Cms\Management\Menu\StoreMenuAction;
use App\Actions\Cms\Management\Menu\UpdateMenuAction;
use App\DTOs\Cms\Management\Menu\StoreMenuData;
use App\DTOs\Cms\Management\Menu\UpdateMenuData;
use App\Models\Menu\Menu;
use App\Models\Spatie\Role;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Symfony\Component\Finder\SplFileInfo;

new class extends Component
{
    /** @var class-string<Menu> */
    #[Locked]
    public string $modelInstance = Menu::class;

    public bool $isUpdate = false;

    // Record data
    public ?int $id = null;

    public ?int $role_id = null;

    public ?string $name = null;

    public ?string $url = null;

    public ?string $icon = null;

    public int $order = 1;

    public ?string $active_pattern = null;

    public int $status = 1;

    #[On('set-action')]
    public function setAction(?int $id = null): void
    {
        $this->resetValidation();

        if ($id) {
            $this->isUpdate = true;
            $this->getRecordData($id);
        } else {
            $this->isUpdate = false;
            $this->reset();
        }
    }

    /**
     * @return Collection<int, Role>
     */
    #[Computed]
    public function roles(): Collection
    {
        return Role::all();
    }

    /**
     * @return array<int, string>
     */
    #[Computed]
    public function icons(): array
    {
        return collect(File::allFiles(resource_path('views/flux/icon')))->map(function (SplFileInfo $file): string {
            return str_replace('.blade.php', '', $file->getFilename());
        })->values()->toArray();
    }

    // Get record data
    public function getRecordData(int $id): void
    {
        Gate::authorize('show'.$this->modelInstance);

        $record = Menu::find($id);
        $this->fill(
            $record->only(
                'id',
                'role_id',
                'name',
                'url',
                'icon',
                'order',
                'active_pattern',
            )
        );
        $this->status = $record->status->value;
    }

    // Handle form submit
    public function submit(StoreMenuAction $storeAction, UpdateMenuAction $updateAction): void
    {
        Gate::authorize(($this->isUpdate ? 'update' : 'create').$this->modelInstance);

        $this->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($this->isUpdate) {
            $updateAction->handle(
                menu: Menu::findOrFail($this->id),
                data: UpdateMenuData::fromArray($this->all()),
            );
        } else {
            $storeAction->handle(
                data: StoreMenuData::fromArray($this->all()),
            );
        }

        // Flush menu cache
        Cache::flush();

        // Toast message
        $this->dispatch('toast',
            type: 'success',
            message: $this->isUpdate ? 'Menu updated successfully.' : 'Menu created successfully.'
        );

        // Reset data table
        $this->dispatch('reset-parent-page');

        // Close modal
        Flux::modal('defaultModal')->close();
    }
};
