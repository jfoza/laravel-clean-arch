<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $path = 'database/migrations/scripts/pg/2024_09_02_192450_create_pg_db_str.sql';
        DB::unprepared(file_get_contents($path));
    }
};
