<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = [
        'nama_tiket',
        'deskripsi_tiket',
        'jumlah_tiket',
        'harga_tiket'
    ];
}
