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
        Schema::create('student_posts', function (Blueprint $table) {
            $table->id();
             // Step 1
            $table->string('location')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');


            // Step 2
            $table->string('phone')->nullable();
            $table->string('country_code')->nullable();

            // Step 3
            $table->text('description')->nullable();

            // Step 4
            $table->json('subjects')->nullable();   // array from step 4
            $table->string('levelText')->nullable();
            $table->string('jobType')->nullable();
            $table->integer('travel_distance')->nullable();
            $table->boolean('meeting_tutorplace')->nullable();

            // Step 5
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('budgetType')->nullable();
            $table->string('genderPreference')->nullable();
            $table->string('needSomeone')->nullable();
            $table->json('language')->nullable();
            $table->string('getutorfrom')->nullable();
            $table->string('files')->nullable();
            $table->unsignedInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_posts');
    }
};
