<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'jumlah',
        'harga_saat_jual',
        'tanggal',
    ];

    /**
     * Relasi: Penjualan belongs to Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}