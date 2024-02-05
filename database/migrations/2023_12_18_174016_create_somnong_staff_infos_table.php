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
        Schema::create('somnong_staff_infos', function (Blueprint $table) {
            $table->string('staff_id');
            $table->string('branch_code');
            $table->string('staff_name')->nullable();
            $table->string('position_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('remark')->nullable();
            $table->boolean('active')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('inputter',250)->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->primary(['staff_id', 'branch_code']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('somnong_staff_infos');
    }
};
