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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('role');
            $table->string('tel');
            $table->string('alternative_tel')->nullable();
            $table->string('address')->nullable();
            $table->string('id_type');
            $table->string('id_number');
            $table->string('status')->default('active');
            $table->date('hire_date')->useCurrent();
            $table->string('shift_type');
            $table->time('shift_start_time');
            $table->time('shift_end_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
