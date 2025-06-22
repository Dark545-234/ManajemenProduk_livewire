<?php

namespace App\Livewire;

use App\Models\Produk; 
use App\Models\Penjualan; 
use App\Models\stok_log; 
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon; 

class ShopProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = ''; 

    protected $listeners = ['productPurchased' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage(); 
    }

    public function buyProduct($produkId, $quantity = 1)
    {
        if ($quantity < 1) {
            session()->flash('shop_error', 'Kuantitas minimal untuk pembelian adalah 1.');
            return;
        }

        $produk = Produk::find($produkId);

        if (!$produk) {
            session()->flash('shop_error', 'Produk tidak ditemukan.');
            return;
        }

        if ($produk->stok < $quantity) {
            session()->flash('shop_error', 'Stok ' . $produk->nama . ' tidak cukup. Sisa stok: ' . $produk->stok);
            return;
        }

        $produk->stok -= $quantity;
        $produk->save();

        Penjualan::create([
            'produk_id' => $produk->id,
            'jumlah' => $quantity,
            'tanggal' => Carbon::now()->toDateString(), 
        ]);

        stok_log::create([
            'produk_id' => $produk->id,
            'jenis' => 'keluar', 
            'jumlah' => $quantity,
            'tanggal' => Carbon::now()->toDateString(),
        ]);

        session()->flash('shop_message', $quantity . ' unit ' . $produk->nama . ' berhasil dibeli!');

        $this->dispatch('productPurchased'); 
        $this->dispatch('penjualanUpdated'); 
        $this->dispatch('stokLogUpdated');   
        $this->dispatch('produkUpdated');    
    }

    public function render()
    {
        $query = Produk::with(['supplier', 'kategori']);

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('harga', 'like', '%' . $this->search . '%')
                  ->orWhereHas('supplier', function($q) {
                      $q->where('nama', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('kategori', function($q) {
                      $q->where('nama', 'like', '%' . $this->search . '%');
                  });
        }

        $query->where('stok', '>', 0);

        $produks = $query->orderBy('nama', 'asc')->paginate(8); // Paginasi produk

        return view('livewire.shop-product-list', [
            'produks' => $produks,
        ]);
    }
}