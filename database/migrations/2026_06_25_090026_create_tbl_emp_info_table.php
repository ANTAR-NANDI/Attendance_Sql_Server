<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblEmpInfo', function (Blueprint $table) {
            // auto_id column mimicking the legacy table's integer identity structure
            $table->integer('auto_id')->identity();

            // Setting User_id as primary key to match original specifications
            $table->string('User_id', 50)->primary();
            $table->string('card_number', 50)->nullable();
            $table->string('strName', 150);
            $table->string('strdepartment', 100)->nullable();
            $table->string('strdesignation', 100)->nullable();

            // SQL Server bits map to booleans in Laravel
            $table->boolean('ysnactive')->default(true);
            $table->string('RelioGion', 50)->nullable();
            $table->string('bloodGroup', 10)->nullable();
            $table->string('Gender', 20)->nullable();
            $table->boolean('ysnAdmin')->default(false);
            $table->string('workStation', 100)->nullable();
            $table->string('shiftName', 100)->nullable();
            $table->integer('orderNumber')->nullable();
            $table->boolean('ysnRoster')->nullable();
            $table->integer('cmpID')->nullable();

            $table->string('entryBy', 50)->nullable();
            $table->dateTime('entryDate')->nullable();
            $table->string('modifyBy', 50)->nullable();
            $table->dateTime('ModifyDate')->nullable();

            $table->string('reporting_boss', 150)->nullable();
            $table->string('password', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('mobile_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('reporting_id', 50)->nullable();
            $table->boolean('super_admin')->nullable();
            $table->date('join_Date')->nullable();
            $table->date('inactive_Date')->nullable();
            $table->string('inactiveReason', 255)->nullable();

            // Image paths can use text/max string values
            $table->text('image')->nullable();
            $table->string('empType', 50)->nullable();
            $table->string('fatherName', 150)->nullable();
            $table->string('motherName', 150)->nullable();
            $table->string('roll', 50)->nullable();
            $table->date('dob')->nullable();
            $table->date('admit_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblEmpInfo');
    }
};
