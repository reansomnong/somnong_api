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
        Schema::create('somnong_quote_files', function (Blueprint $table) {
            $table->string('sysdoc');
            $table->string('quote_code');
            $table->string('branch_code');
            $table->string('file_name',250);
            $table->string('description',250);
            $table->string('extension',250);
            $table->string('inputter',250)->nullable();
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
        Schema::dropIfExists('somnong_quote_files');
    }
};
