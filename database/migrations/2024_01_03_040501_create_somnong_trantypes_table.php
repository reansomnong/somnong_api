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
        Schema::create('somnong_trantypes', function (Blueprint $table) {
            $table->string('tran_code');
            $table->string('description');
            $table->boolean('active');
            $table->decimal('value', 12, 3)->nullable();
            $table->string('inputter',250)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->primary(['tran_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('somnong_trantypes');
    }
};
