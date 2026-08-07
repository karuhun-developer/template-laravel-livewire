<?php

declare(strict_types=1);

namespace App\DTOs\Cms\Management\User;

final readonly class UpdateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $role,
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
            email: $data['email'],
            role: $data['role'],
        );
    }

    /**
     * Convert the DTO to the model attributes array.
     *
     * @return array{name: string, email: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
