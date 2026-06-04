<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrdFile extends Model
{
    protected $fillable = [
        'brd_id',
        'nama_file',
        'path_file',
    ];

    public function brd()
    {
        return $this->belongsTo(Brd::class);
    }
}