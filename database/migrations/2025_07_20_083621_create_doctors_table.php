<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('address')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('set null');
            $table->string('role')->default('doctor');
            $table->string('image')->nullable();
            $table->string('specialty')->nullable();
            $table->text('credentials')->nullable();
            $table->json('availability_schedule')->nullable();
            $table->foreignId('status_id')->constrained('statuses')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
