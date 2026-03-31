<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('appointments')) {
            return;
        }

        if (Schema::hasColumn('appointments', 'start_time') && Schema::hasColumn('appointments', 'end_time')) {
            $driver = Schema::getConnection()->getDriverName();

            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE appointments MODIFY start_time DATETIME NULL, MODIFY end_time DATETIME NULL');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE appointments ALTER COLUMN start_time DROP NOT NULL');
                DB::statement('ALTER TABLE appointments ALTER COLUMN end_time DROP NOT NULL');
            }
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('appointments')) {
            return;
        }

        if (Schema::hasColumn('appointments', 'start_time') && Schema::hasColumn('appointments', 'end_time')) {
            $driver = Schema::getConnection()->getDriverName();

            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE appointments MODIFY start_time DATETIME NOT NULL, MODIFY end_time DATETIME NOT NULL');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE appointments ALTER COLUMN start_time SET NOT NULL');
                DB::statement('ALTER TABLE appointments ALTER COLUMN end_time SET NOT NULL');
            }
        }
    }
};
