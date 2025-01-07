<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clearance_hr_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clearance_request_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('clearance_request_id')
                  ->references('id')
                  ->on('clearance_requests')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_hr_requirements');
    }
};
