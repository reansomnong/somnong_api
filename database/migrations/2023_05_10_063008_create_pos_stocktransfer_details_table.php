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
        Schema::create('pos_stocktransfer_details', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('branch_code');
            $table->string('sto_tran_code');
            $table->string('pro_code')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('qty', 12, 3)->nullable();
            $table->string('remark')->nullable();

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
        Schema::dropIfExists('pos_stocktransfer_details');
    }
};
