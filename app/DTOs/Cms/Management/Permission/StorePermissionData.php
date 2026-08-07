<?php

declare(strict_types=1);

namespace App\DTOs\Cms\Management\Permission;

final readonly class StorePermissionData
{
    public function __construct(
        public string $name,
        public string $guardName,
    ) {}

    /**
     * Create the DTO from an array of data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            guardName: $data['guard_name'],
        );
    }

    /**
     * Convert the DTO to the model attributes array.
     *
     * @return array{name: string, guard_name: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guardName,
        ];
    }
}
