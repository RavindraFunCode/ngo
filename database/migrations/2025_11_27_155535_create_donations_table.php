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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3);
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending')->index();
            $table->string('payment_gateway', 50)->index();
            $table->string('transaction_id')->nullable()->index();
            $table->string('payment_reference')->nullable();
            $table->json('payment_details')->nullable();
            $table->string('donor_name');
            $table->string('donor_email')->nullable();
            $table->string('donor_phone', 50)->nullable();
            $table->text('donor_address')->nullable();
            $table->boolean('is_anonymous')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
