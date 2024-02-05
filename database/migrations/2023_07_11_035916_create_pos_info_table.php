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
        Schema::create('pos_info', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('pos_code');
            $table->string('branch_code');
            $table->string('table_num')->nullable();
            $table->string('people_num')->nullable();
            $table->decimal('vat', 12, 3)->nullable();
            $table->decimal('vat_amount', 12, 3)->nullable();
            $table->decimal('subtotal', 12, 3)->nullable();
            $table->decimal('disamount', 12, 3)->nullable();
            $table->decimal('total', 12, 3)->nullable();
            $table->string('remark')->nullable();
            
            $table->primary(['sysdoc','pos_code', 'branch_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_una_information');
    }
};
