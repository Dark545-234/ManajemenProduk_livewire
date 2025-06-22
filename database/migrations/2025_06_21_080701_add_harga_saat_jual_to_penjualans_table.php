<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            // Tambahkan kolom harga_saat_jual
            $table->decimal('harga_saat_jual', 10, 2)->after('jumlah')->nullable();
            // Gunakan nullable() jika ada data penjualan lama yang tidak memiliki kolom ini.
            // Setelah data lama diperbarui, Anda bisa menghapus nullable() dan menambahkan ->default(0.00) jika mau.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->dropColumn('harga_saat_jual');
        });
    }
};