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
        Schema::create('pos_vat', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('branch_code');
            $table->decimal('amount', 12, 3)->nullable();
            $table->string('inputter',250)->nullable();
            $table->timestamps();
            $table->primary(['sysdoc', 'branch_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_vat');
    }
};
