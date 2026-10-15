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
        Schema::create('form_sections', function (Blueprint $table) {
            $table->id();

            // Relasi ke form_templates
            $table->foreignId('form_template_id')
                  ->constrained('form_templates')
                  ->cascadeOnDelete();

            // Nama section
            $table->string('section_title');

            // Penjelasan section (opsional)
            $table->text('description')->nullable();

            // Urutan section dalam form
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_sections');
    }
};