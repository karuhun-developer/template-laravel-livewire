<?php

namespace App\Enums;

enum Alert: string {
    case success = 'success';
    case error = 'error';
    case warning = 'warning';
    case info = 'info';
}
