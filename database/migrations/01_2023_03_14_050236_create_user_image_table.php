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
        Schema::create('user_images', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',20);
            $table->string('branch_code',10);
            $table->string('file_name',250);
            $table->string('description',250);
            $table->string('extension',250);
            $table->string('inputter',250)->nullable();
            $table->timestamps();

        });


    }

    public function down(): void
    {
        Schema::dropIfExists('user_images');
    }
};
