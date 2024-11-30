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
        Schema::create('clearance_approvals', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('request_id'); 
            $table->unsignedInteger('clearance_id');
            $table->unsignedBigInteger('employee_type'); 
            $table->unsignedInteger('seqno');
            $table->unsignedBigInteger('clearing_official_id'); 
            $table->string('comment', 255)->nullable(); 
            $table->tinyInteger('isApproved')->default(0); 
            $table->timestamps(); 
    
            // Foreign key constraints
            $table->foreign('request_id')->references('id')->on('clearance_requests')->onDelete('cascade');
            $table->foreign('clearance_id')->references('id')->on('clearance')->onDelete('cascade');
            $table->foreign('employee_type')->references('id')->on('employment_types')->onDelete('cascade');
            $table->foreign('clearing_official_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_approvals');
    }
};
