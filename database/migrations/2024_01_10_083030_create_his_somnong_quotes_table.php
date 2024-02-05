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
        Schema::create('his_somnong_quotes', function (Blueprint $table) {
            $table->string('quote_code');
            $table->string('branch_code');
            $table->string('title');
            $table->string('client_id');
            $table->string('quote_type')->nullable();
            $table->decimal('cost', 12, 3)->nullable();
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('address')->nullable();
            $table->string('google_map')->nullable();
            $table->string('remark')->nullable();
            $table->dateTime('tran_date')->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('his_somnong_quotes');
    }
};
