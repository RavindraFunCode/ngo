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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->index();
            $table->decimal('target_amount', 12, 2)->nullable();
            $table->decimal('raised_amount', 12, 2)->default(0.00);
            $table->string('currency', 3)->default('INR');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(0)->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('campaign_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
            $table->unique(['campaign_id', 'language_id']);
            $table->unique(['language_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_translations');
        Schema::dropIfExists('campaigns');
    }
};
