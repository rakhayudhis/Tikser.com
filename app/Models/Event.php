<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'nama_event',
        'artist',
        'tanggal_event',
        'tempat_event',
        'detail_event',
    ];
}
