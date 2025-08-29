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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('DOB')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('image')->nullable();
            $table->string('contact_info')->nullable();
            $table->text('medical_history')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
