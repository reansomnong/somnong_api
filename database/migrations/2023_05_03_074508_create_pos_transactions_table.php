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
        Schema::create('pos_transactions', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('branch_code',25);
            $table->string('stc_code',25);
            $table->string('pro_code');
            $table->string('barcode');
            $table->string('trancode');
            $table->decimal('qty', 12, 2)->nullable();
            $table->decimal('qty_total', 12, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('referent')->nullable();
            $table->string('remark')->nullable();
            $table->date('trandate')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

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
        Schema::dropIfExists('pos_transactions');
    }
};
