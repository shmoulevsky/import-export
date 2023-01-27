<?php

namespace App\Modules\Export\Entities;

class ExportType
{
    public const PHP = 'php';
    public const LARAVEL_EXCEL = 'laravel-excel';
    public const SPATIE_EXCEL = 'spatie-excel';

    public static function getAll()
    {
        return [
            self::PHP => 'Simple php',
            self::LARAVEL_EXCEL => 'Laravel-excel',
            self::SPATIE_EXCEL => 'Spatie simple excel',
        ];
    }
}
