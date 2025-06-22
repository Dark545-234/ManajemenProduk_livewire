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
        Schema::create('stok_logs', function (Blueprint $table) {
            $table->id();
            // Foreign Key untuk produk_id
            $table->foreignId('produk_id')
                  ->constrained('produks') // Merujuk ke tabel 'produks'
                  ->onDelete('cascade');  // Jika produk dihapus, log stok terkait ikut terhapus

            // Jenis perubahan stok (misal: 'masuk', 'keluar', 'penyesuaian')
            $table->string('jenis');

            // Jumlah perubahan stok (bisa positif untuk masuk, negatif untuk keluar, atau selalu positif dengan jenis yang mengindikasikan)
            $table->integer('jumlah');

            $table->date('tanggal'); // Tanggal kejadian log

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_logs');
    }
};