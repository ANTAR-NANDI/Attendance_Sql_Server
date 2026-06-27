<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tblShift')) {
            Schema::create('tblShift', function (Blueprint $table) {
                // Identity column mapped to standard integer generation 
                $table->id();
                $table->string('shiftName', 100);
                $table->time('startTime');
                $table->decimal('workinghour', 5, 2);
                $table->boolean('ysnActive')->default(true);
                $table->time('daystart')->nullable();
                $table->decimal('dayhour', 5, 2)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tblShift');
    }
};
