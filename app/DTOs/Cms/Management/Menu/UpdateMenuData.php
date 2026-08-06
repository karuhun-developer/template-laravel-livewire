<?php

namespace App\DTOs\Cms\Management\Menu;

final readonly class UpdateMenuData
{
    public function __construct(
        public int $roleId,
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
     * @return array{role_id: int, name: string, url: string, icon: ?string, order: int, active_pattern: ?string, status: int}
     */
    public function toArray(): array
    {
        return [
            'role_id' => $this->roleId,
            'name' => $this->name,
            'url' => $this->url,
            'icon' => $this->icon,
            'order' => $this->order,
            'active_pattern' => $this->activePattern,
            'status' => $this->status,
        ];
    }
}
