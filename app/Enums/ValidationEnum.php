<?php

namespace App\Enums;

enum ValidationEnum: int {
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = 2;

    public function label(): string {
        return match($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    public function color(): string {
        return match($this) {
            self::PENDING => 'badge bg-warning text-white',
            self::APPROVED => 'badge bg-success text-white',
            self::REJECTED => 'badge bg-danger text-white',
        };
    }

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
