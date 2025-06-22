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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            // Foreign Key untuk produk_id
            $table->foreignId('produk_id')
                  ->constrained('produks') // Merujuk ke tabel 'produks'
                  ->onDelete('cascade');  // Jika produk dihapus, data penjualan terkait ikut terhapus

            $table->integer('jumlah'); // Kuantitas produk yang terjual
            $table->date('tanggal');   // Tanggal penjualan

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};