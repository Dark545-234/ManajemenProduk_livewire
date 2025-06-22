<?php

namespace App\Livewire;

use App\Models\Produk;   
use Livewire\Component;
use Livewire\WithPagination;

class ProdukTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $katakunci;
    public $sortcolum = 'nama'; 
    public $sortarah = 'asc';
    public $hapus_selected_id = [];
    public $produk_id_to_delete; 
    public $select_all = false;

    protected $listeners = ['produkUpdated' => '$refresh']; 

    public function updatingKatakunci()
    {
        $this->resetPage(); 
    }

    public function sort($sortcolumName)
    {
        if ($this->sortcolum === $sortcolumName) {
            $this->sortarah = $this->sortarah === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortcolum = $sortcolumName;
            $this->sortarah = 'asc';
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->hapus_selected_id = Produk::pluck('id')->toArray();
        } else {
            $this->hapus_selected_id = [];
        }
    }

    public function delete_confirmation($id = '')
    {
        if ($id != '') {
            $this->produk_id_to_delete = $id; 
            $this->hapus_selected_id = []; 
        } else {
            $this->produk_id_to_delete = null; 
        }
    }

    public function delete()
    {
        if ($this->produk_id_to_delete) {
            // Hapus satu produk
            Produk::destroy($this->produk_id_to_delete);
            session()->flash('pesan', 'Data Produk berhasil dihapus.');
        } elseif (count($this->hapus_selected_id) > 0) {
            // Hapus banyak produk
            Produk::whereIn('id', $this->hapus_selected_id)->delete();
            session()->flash('pesan', count($this->hapus_selected_id) . ' Data Produk berhasil dihapus.');
        }

        $this->produk_id_to_delete = null; 
        $this->hapus_selected_id = []; 
        $this->select_all = false; 
        $this->resetPage(); 
        $this->dispatch('produkUpdated'); 
    }

    public function triggerEdit($id)
    {
        $this->dispatch('editProduk', $id); 
    }

    public function render()
    {
        $data = Produk::with(['supplier', 'kategori']);

        if ($this->katakunci) {
            // Logika pencarian yang disesuaikan untuk Produk
            $data->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('harga', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('stok', 'like', '%' . $this->katakunci . '%')
                      // Pencarian berdasarkan nama supplier melalui relasi
                      ->orWhereHas('supplier', function ($q) {
                          $q->where('nama', 'like', '%' . $this->katakunci . '%');
                      })
                      // Pencarian berdasarkan nama kategori melalui relasi
                      ->orWhereHas('kategori', function ($q) {
                          $q->where('nama', 'like', '%' . $this->katakunci . '%');
                      });
            });
        }

        $data->orderBy($this->sortcolum, $this->sortarah);

        $dataProduks = $data->paginate(5); 

        return view('livewire.produk-table', [
            'dataProduks' => $dataProduks, 
        ]);
    }
}