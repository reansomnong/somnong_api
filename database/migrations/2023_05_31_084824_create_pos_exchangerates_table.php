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
        Schema::create('pos_exchangerates', function (Blueprint $table) {
            $table->string('sysnum',20);
            $table->string('branch_code',20);

            $table->string('base_sysdoc',20);
            $table->string('currency_code',20);
            $table->decimal('amount', 12, 3);

            $table->softDeletes();
            $table->timestamps();
            $table->primary(['sysnum', 'branch_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_exchangerates');
    }
};
