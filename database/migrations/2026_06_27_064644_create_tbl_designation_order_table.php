<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tblDesignationOrder')) {
            Schema::create('tblDesignationOrder', function (Blueprint $table) {
                $table->id();
                $table->string('designation', 150);
                $table->integer('numOrder')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tblDesignationOrder');
    }
};
