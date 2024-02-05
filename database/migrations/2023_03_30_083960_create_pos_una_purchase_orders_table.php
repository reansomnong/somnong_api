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
        Schema::create('pos_una_purchase_orders', function (Blueprint $table) {
            $table->string('pur_code');
            $table->string('branch_code');
            $table->string('sup_code')->nullable();
            $table->string('invoice')->nullable();
            $table->decimal('subtotal', 12, 3)->nullable();
            $table->decimal('disamount', 12, 3)->nullable();
            $table->string('remark')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->primary(['pur_code', 'branch_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_purchase_orders');
    }
};
