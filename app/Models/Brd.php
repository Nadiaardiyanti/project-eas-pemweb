<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brd extends Model
{
    protected $fillable = [
    'nomor_brd',
    'client',
    'judul',
    'deskripsi',
    'tanggal_upload',
    'deadline',
    'sales_id',
    'status_engineering',
    'notes_engineering',
    'status_finance',
    'notes_finance',
    'status_final',
];

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function files()
    {
        return $this->hasMany(BrdFile::class);
    }

    public function beritaAcara()
    {
    return $this->hasOne(BeritaAcara::class);
    }
}