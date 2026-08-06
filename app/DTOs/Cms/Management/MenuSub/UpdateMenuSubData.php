<?php

namespace App\DTOs\Cms\Management\MenuSub;

final readonly class UpdateMenuSubData
{
    public function __construct(
        public int $roleId,
        public int $menuId,
        public string $name,
        public string $url,
        public ?string $icon,
        public int $order,
        public ?string $activePattern,
        public int $status,
    ) {}

    /**
     * Create the DTO from an array of data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            roleId: (int) $data['role_id'],
            menuId: (int) $data['menu_id'],
            name: $data['name'],
            url: $data['url'],
            icon: $data['icon'] ?? null,
            order: (int) $data['order'],
            activePattern: $data['active_pattern'] ?? null,
            status: (int) $data['status'],
        );
    }

    /**
     * Convert the DTO to the model attributes array.
     *
     * @return array{role_id: int, menu_id: int, name: string, url: string, icon: ?string, order: int, active_pattern: ?string, status: int}
     */
    public function toArray(): array
    {
        return [
            'role_id' => $this->roleId,
            'menu_id' => $this->menuId,
            'name' => $this->name,
            'url' => $this->url,
            'icon' => $this->icon,
            'order' => $this->order,
            'active_pattern' => $this->activePattern,
            'status' => $this->status,
        ];
    }
}
