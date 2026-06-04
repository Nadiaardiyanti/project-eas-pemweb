<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->id();

            $table->foreignId('brd_id')
                  ->constrained('brds')
                  ->onDelete('cascade');

            $table->string('nomor_ba');
            $table->string('nama_project');
            $table->string('customer');
            $table->date('tanggal_ba');

            $table->string('pihak_pertama')->nullable();
            $table->string('pihak_kedua')->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};