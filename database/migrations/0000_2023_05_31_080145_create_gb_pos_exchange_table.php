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
        Schema::create('gb_pos_exchanges', function (Blueprint $table) {
            $table->string('currency_code',20)->unique();
            $table->string('currency',250);
            $table->string('symbol',250);
            $table->decimal('small_amount', 12, 10)->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();
            $table->primary('currency_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gb_pos_exchanges');
    }
};
