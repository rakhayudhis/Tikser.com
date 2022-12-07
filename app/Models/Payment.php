<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'nama_user',
        'email',
        'no_hp',
        'nama_tiket',
        'jumlah_tiket',
        'total_harga',
    ];
}
