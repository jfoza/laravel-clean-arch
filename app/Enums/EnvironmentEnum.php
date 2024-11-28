<?php
declare(strict_types=1);

namespace App\Enums;

enum EnvironmentEnum: string {
    case LOCAL = 'local';
    case PRODUCTION = 'production';
    case STAGING = 'staging';
    case TESTING = 'testing';
}
