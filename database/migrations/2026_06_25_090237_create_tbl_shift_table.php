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
        Schema::create('tblShift', function (Blueprint $table) {
            // Identity column mapped to standard integer generation 
            $table->id();
            $table->integer('autoID')->identity();

            // Primary key set explicitly on shiftName to remain uniform with your schema routing
            $table->string('shiftName', 100)->primary();
            $table->string('startTime', 50)->nullable();

            // Decimal storage mapped with precision requirements for exact hours calculations
            $table->decimal('workinghour', 18, 2)->nullable();
            $table->boolean('ysnActive')->default(true);
            $table->string('daystart', 50)->nullable();
            $table->decimal('dayhour', 18, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblShift');
    }
};
