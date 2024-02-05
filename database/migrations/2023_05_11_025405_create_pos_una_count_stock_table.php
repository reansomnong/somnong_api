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
        Schema::create('pos_una_count_stock', function (Blueprint $table) {
            $table->string('co_tran_code');
            $table->string('branch_code');
            $table->string('stc_code')->nullable();
            $table->string('remark')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['co_tran_code', 'branch_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('una_count_stock');
    }
};
