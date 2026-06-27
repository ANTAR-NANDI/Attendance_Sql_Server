<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblLeave', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->string('empID', 20);
            $table->string('empType', 50)->nullable();

            // Leave
            $table->unsignedBigInteger('leave_type_id');

            $table->date('leave_from');
            $table->date('leave_to');

            $table->integer('total_days');

            $table->text('reason')->nullable();

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            // Approval
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->foreign('leave_type_id')
                ->references('id')
                ->on('tblLeaveType')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblLeave');
    }
};
