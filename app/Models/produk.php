<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'supplier_id',
        'kategori_id',
    ];
    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
     // --- Relasi Baru ---
    /**
     * Relasi: Produk has many Penjualan
     */
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    /**
     * Relasi: Produk has many StokLog
     */
    public function stokLogs()
    {
        return $this->hasMany(stok_log::class);
    }
}
