<?php

declare(strict_types=1);

namespace App\DTOs\Api\V1\Auth;

final readonly class ResetPasswordData
{
    public function __construct(
        public string $email,
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
        );
    }
}
