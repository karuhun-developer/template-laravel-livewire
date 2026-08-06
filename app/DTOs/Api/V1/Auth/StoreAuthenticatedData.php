<?php

namespace App\DTOs\Api\V1\Auth;

final readonly class StoreAuthenticatedData
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    /**
     * Create the DTO from an array of data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
        );
    }

    /**
     * Convert the DTO to the credentials array.
     *
     * @return array{email: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
