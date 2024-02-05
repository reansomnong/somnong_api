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
        Schema::create('somnong_collect_payments', function (Blueprint $table) {
            $table->string('payment_id');
            $table->string('referent_code');
            $table->string('branch_code');
            $table->string('currency_code');
            $table->string('tran_code');
            $table->string('ref_exchange');
            $table->decimal('amount', 12, 3)->nullable();
            $table->string('remark')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['referent_code', 'branch_code','payment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('somnong_collect_payments');
    }
};
