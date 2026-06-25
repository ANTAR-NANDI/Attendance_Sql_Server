<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblDepartmentOrder', function (Blueprint $table) {
            $table->id();
            $table->string('departmentName', 100)->primary(); // Matching primary lookup key string
            $table->integer('order_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblDepartmentOrder');
    }
};
