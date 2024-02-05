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
        Schema::create('somnong_quote_details', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('quote_code');
            $table->string('branch_code');
            $table->string('status_code',250)->nullable();
            $table->string('leader_code',250)->nullable();
            $table->string('inputter',250)->nullable();
            $table->string('authorizer',250)->nullable();
            $table->dateTime('auth_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['quote_code', 'branch_code','sysdoc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('somnong_quote_details');
    }
};
