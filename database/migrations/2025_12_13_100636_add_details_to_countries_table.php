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
        Schema::table('countries', function (Blueprint $table) {
            $table->string('currency_code', 3)->nullable()->after('phonecode');
            $table->string('currency_symbol', 10)->nullable()->after('currency_code');
            $table->integer('min_phone_length')->default(10)->after('currency_symbol');
            $table->integer('max_phone_length')->default(10)->after('min_phone_length');
            $table->boolean('is_active')->default(false)->after('max_phone_length');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            //
        });
    }
};
