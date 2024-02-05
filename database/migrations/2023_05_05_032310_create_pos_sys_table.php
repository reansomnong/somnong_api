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
        Schema::create('pos_sys', function (Blueprint $table) {
            $table->string('con_name', 25);
            $table->string('con_value', 250);
            $table->string('con_title', 250);
            $table->boolean('active')->nullable();
            $table->timestamps();

            $table->primary(['con_name', 'con_value']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_sys');
    }
};
