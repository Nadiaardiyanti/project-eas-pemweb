<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'berita_acara_id',
        'nomor_invoice',
        'tanggal_invoice',
        'deadline_pembayaran',
        'total_nominal',
        'dp_masuk',
        'sisa_pembayaran',
        'status',
        'keterangan',
    ];

    public function beritaAcara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}