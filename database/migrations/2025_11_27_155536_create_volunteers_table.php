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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->json('interest_areas')->nullable();
            $table->text('experience')->nullable();
            $table->string('availability')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'in_review', 'approved', 'rejected'])->default('new')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
