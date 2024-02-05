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
        Schema::create('pos_stocktransfer', function (Blueprint $table) {
            $table->string('sto_tran_code');
            $table->string('branch_code');
            $table->string('sto_code_from')->nullable();
            $table->string('sto_code_to')->nullable();
            $table->string('remark')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->primary(['sto_tran_code', 'branch_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_stocktransfer');
    }
};
