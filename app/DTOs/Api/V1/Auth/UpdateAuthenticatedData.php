<?php

namespace App\DTOs\Api\V1\Auth;

use Illuminate\Http\UploadedFile;

final readonly class UpdateAuthenticatedData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $password,
        public ?UploadedFile $image,
    ) {}

    /**
     * Create the DTO from an array of data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        $image = $data['image'] ?? null;

        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'] ?? null,
            password: $data['password'] ?? null,
            image: $image instanceof UploadedFile ? $image : null,
        );
    }
}
