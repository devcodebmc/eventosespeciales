<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique(); // EEL-2026-001
            $table->string('client_name')->nullable(); // "A quien corresponda" o nombre
            $table->date('quotation_date');
            $table->json('items'); // [{descripcion, cantidad, precio_unitario, total}]
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('iva', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->text('raw_input')->nullable(); // Texto original pegado
            $table->string('pdf_path')->nullable();
            $table->string('word_path')->nullable();
            $table->string('excel_path')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};