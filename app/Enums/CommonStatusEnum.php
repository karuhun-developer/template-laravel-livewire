<?php

namespace App\Enums;

enum CommonStatusEnum: int {
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function label(): string {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function color(): string {
        return match($this) {
            self::ACTIVE => 'badge bg-success text-white',
            self::INACTIVE => 'badge bg-danger text-white',
        };
    }

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
