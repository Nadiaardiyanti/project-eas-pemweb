<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $fillable = [
    'brd_id',
    'nomor_ba',
    'nama_project',
    'customer',
    'tanggal_ba',
    'deadline',
    'status',
    'notes_finance',
    'pihak_pertama',
    'pihak_kedua',
    'keterangan',
    ];

    public function brd()
    {
        return $this->belongsTo(Brd::class);
    }

    public function invoice()
    {
    return $this->hasOne(Invoice::class);
    }
}