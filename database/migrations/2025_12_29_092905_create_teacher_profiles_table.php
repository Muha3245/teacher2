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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('headline')->nullable(); // instead of iam
            $table->string('full_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birth_date')->nullable();

            $table->text('address')->nullable();
            $table->string('location')->nullable();

            // Teaching info
            $table->enum('charge_period', ['hourly', 'daily', 'weekly', 'monthly'])->nullable();
            $table->decimal('min_price', 8, 2)->nullable();
            $table->decimal('max_price', 8, 2)->nullable();
            $table->integer('years_teaching')->nullable();
            $table->integer('years_online')->nullable();

            $table->boolean('willing_to_travel')->default(false);
            $table->integer('travel_km')->nullable();
            $table->boolean('has_digital_pen')->default(false);
            $table->boolean('helps_homework')->default(false);
            $table->enum('opportunity', ['full_time', 'part_time', 'both'])->nullable();

            $table->text('profile_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
