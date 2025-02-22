<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'tanggal_pengajuan',
        'jumlah_pinjaman',
        'guru',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'pengajuan_id'); 
    }
}
