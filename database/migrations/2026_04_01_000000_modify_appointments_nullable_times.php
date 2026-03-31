<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            DB::statement(
                'ALTER TABLE `appointments` MODIFY `start_time` DATETIME NULL, MODIFY `end_time` DATETIME NULL'
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('appointments')) {
            return;
        }

        if (Schema::hasColumn('appointments', 'start_time') && Schema::hasColumn('appointments', 'end_time')) {
            DB::statement(
                'ALTER TABLE `appointments` MODIFY `start_time` DATETIME NOT NULL, MODIFY `end_time` DATETIME NOT NULL'
            );
        }
    }
};
