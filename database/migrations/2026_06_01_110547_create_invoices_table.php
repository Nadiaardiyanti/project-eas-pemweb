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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();

        $table->foreignId('berita_acara_id')
              ->constrained('berita_acaras')
              ->onDelete('cascade');

        $table->string('nomor_invoice');
        $table->date('tanggal_invoice');
        $table->date('deadline_pembayaran')->nullable();

        $table->decimal('total_nominal', 15, 2);
        $table->decimal('dp_masuk', 15, 2)->default(0);
        $table->decimal('sisa_pembayaran', 15, 2)->default(0);

        $table->enum('status', ['pending', 'lunas'])
              ->default('pending');

        $table->text('keterangan')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('invoices');
}
};
