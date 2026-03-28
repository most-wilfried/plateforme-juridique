<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'lawyer_id')) {
                $table->foreignId('lawyer_id')->nullable()->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('appointments', 'client_id')) {
                $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('appointments', 'start_time')) {
                $table->dateTime('start_time')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'end_time')) {
                $table->dateTime('end_time')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'status')) {
                $table->string('status')->default('pending');
            }
            if (!Schema::hasColumn('appointments', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('appointments', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('appointments', 'end_time')) {
                $table->dropColumn('end_time');
            }
            if (Schema::hasColumn('appointments', 'start_time')) {
                $table->dropColumn('start_time');
            }
            if (Schema::hasColumn('appointments', 'client_id')) {
                $table->dropForeign(['client_id']);
                $table->dropColumn('client_id');
            }
            if (Schema::hasColumn('appointments', 'lawyer_id')) {
                $table->dropForeign(['lawyer_id']);
                $table->dropColumn('lawyer_id');
            }
        });
    }
};