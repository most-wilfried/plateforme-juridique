<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lawyer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bar_number')->nullable();
            $table->string('phone')->nullable();
            $table->integer('experience_years')->nullable();
            $table->text('bio')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->string('currency')->nullable();
            $table->json('specialties')->nullable();
            $table->json('languages')->nullable();
            $table->json('working_days')->nullable();
            $table->time('work_start')->nullable();
            $table->time('work_end')->nullable();
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyer_profiles');
    }
};
