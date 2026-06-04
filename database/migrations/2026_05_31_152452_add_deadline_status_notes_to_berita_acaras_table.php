<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->date('deadline')->nullable()->after('tanggal_ba');
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->after('deadline');
            $table->text('notes_finance')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'status', 'notes_finance']);
        });
    }
};