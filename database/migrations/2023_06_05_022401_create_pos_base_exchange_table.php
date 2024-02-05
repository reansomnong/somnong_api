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
        Schema::create('pos_base_exchange', function (Blueprint $table) {
            $table->string('sysdoc',20);
            $table->string('branch_code',20);
            $table->string('currency_code',20);
            $table->decimal('amount', 12, 3);
            $table->decimal('small_amount', 12, 3);

            $table->softDeletes();
            $table->timestamps();
            $table->primary(['sysdoc', 'branch_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_base_exchange');
    }
};
