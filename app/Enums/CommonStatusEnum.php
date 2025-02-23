<?php

namespace App\Enums;

enum CommonStatusEnum: int {
    case ACTIVE = 1;
    case INACTIVE = -1;

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
}
