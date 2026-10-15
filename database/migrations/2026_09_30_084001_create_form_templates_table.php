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
        Schema::create('form_templates', function (Blueprint $table) {
            $table->id();

            // Kode resmi form, contoh: QC-AS-0128
            $table->string('form_code')->unique();

            // Nama form, contoh: JOB EVALUATION (JE)
            $table->string('name');

            // Penjelasan singkat mengenai form
            $table->text('description')->nullable();

            // Versi template
            $table->string('version')->default('1.0');

            // Status template
            // active = dapat digunakan
            // inactive = tidak dapat digunakan
            $table->enum('status', ['active', 'inactive'])
                  ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_templates');
    }
};