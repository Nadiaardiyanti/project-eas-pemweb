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
        Schema::create('brd_files', function (Blueprint $table) {
    $table->id();
    $table->foreignId('brd_id')->constrained('brds')->onDelete('cascade');
    $table->string('nama_file');
    $table->string('path_file');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brd_files');
    }
};
