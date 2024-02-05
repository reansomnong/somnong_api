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
        Schema::create('pos_pos', function (Blueprint $table) {
            $table->string('pos_code');
            $table->string('branch_code');
            $table->string('cus_code')->nullable();
            $table->string('ref_exchange',20)->nullable();
            $table->string('referent')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->primary(['pos_code', 'branch_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_pos');
    }
};
