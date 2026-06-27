<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tblHolidaySetup')) {
            Schema::create('tblHolidaySetup', function (Blueprint $table) {
                $table->id();
                $table->string('HolidayName', 200);
                $table->date('holidaydate');
                $table->text('strDescription')->nullable();
                $table->string('type', 50);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tblHolidaySetup');
    }
};
