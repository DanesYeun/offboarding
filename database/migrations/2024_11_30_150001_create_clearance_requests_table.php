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
        Schema::create('clearance_requests', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('employment_type')->unsigned();
            $table->unsignedInteger('purpose')->unsigned();
            $table->string('attachment_file_path');
            $table->text('remarks')->nullable();
            $table->bigInteger('status')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employment_type')->references('id')->on('employment_types')->onDelete('cascade');
            $table->foreign('purpose')->references('id')->on('clearance_purpose')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_requests');
    }
};
