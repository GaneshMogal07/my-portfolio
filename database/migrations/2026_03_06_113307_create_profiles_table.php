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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('summary')->nullable();
            $table->string('image_path')->nullable();
            $table->string('resume_pdf_path')->nullable();
            $table->string('resume_doc_path')->nullable();
            $table->string('current_job_title')->nullable();
            $table->string('current_job_company')->nullable();
            $table->date('current_job_start_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
