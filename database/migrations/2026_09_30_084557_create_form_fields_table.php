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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();

            // Relasi ke section
            $table->foreignId('form_section_id')
                  ->constrained('form_sections')
                  ->cascadeOnDelete();

            // Nama field untuk kebutuhan sistem
            // Contoh: aircraft_registration
            $table->string('field_name');

            // Label yang ditampilkan kepada user
            // Contoh: Aircraft Registration
            $table->string('field_label');

            // Jenis input
            // text, textarea, date, number, select, checkbox
            $table->string('field_type')->default('text');

            // Pilihan untuk field select
            // Disimpan dalam format JSON
            $table->json('options')->nullable();

            // Apakah field wajib diisi?
            $table->boolean('is_required')->default(false);

            // Urutan field dalam section
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};