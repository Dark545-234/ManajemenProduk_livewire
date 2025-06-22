<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_log extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'jenis',
        'jumlah',
        'tanggal',
    ];

    /**
     * Relasi: StokLog belongs to Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}