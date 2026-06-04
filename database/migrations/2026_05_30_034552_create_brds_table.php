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
        Schema::create('brds', function (Blueprint $table) {
    $table->id();
    $table->string('nomor_brd');
    $table->string('judul');
    $table->text('deskripsi')->nullable();
    $table->date('tanggal_upload');
    $table->date('deadline');
    $table->foreignId('sales_id')->constrained('users')->onDelete('cascade');

    $table->enum('status_engineering', ['pending', 'approved', 'rejected'])->default('pending');
    $table->text('notes_engineering')->nullable();

    $table->enum('status_finance', ['pending', 'approved', 'rejected'])->default('pending');
    $table->text('notes_finance')->nullable();

    $table->enum('status_final', ['pending', 'approved', 'rejected', 'revision'])->default('pending');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brds');
    }
};
