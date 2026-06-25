<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblDesignationOrder', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 100)->primary(); // Matching primary lookup key string
            $table->integer('numOrder')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblDeignationOrder');
    }
};
