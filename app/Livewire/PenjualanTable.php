<?php

namespace App\Livewire;

use App\Models\Penjualan;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon; 

class PenjualanTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $katakunci;
    public $sortcolum = 'tanggal';
    public $sortarah = 'desc';
    public $hapus_selected_id = [];
    public $penjualan_id_to_delete;
    public $select_all = false;

    public $totalPenjualanHarian = 0;

    protected $listeners = ['penjualanUpdated' => 'refreshData']; 

    public function mount()
    {
        $this->calculateTotalPenjualanHarian(); 
    }

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
            $this->hapus_selected_id = Penjualan::pluck('id')->toArray();
        } else {
            $this->hapus_selected_id = [];
        }
    }

    public function delete_confirmation($id = '')
    {
        if ($id != '') {
            $this->penjualan_id_to_delete = $id;
            $this->hapus_selected_id = [];
        } else {
            $this->penjualan_id_to_delete = null;
        }
    }

    public function delete()
    {
        if ($this->penjualan_id_to_delete) {
            $penjualan = Penjualan::find($this->penjualan_id_to_delete);
            if ($penjualan) {
                $produk = $penjualan->produk; 
                if ($produk) {
                    $produk->stok += $penjualan->jumlah; 
                    $produk->save();
                    
                }
                $penjualan->delete();
                session()->flash('pesan', 'Data Penjualan berhasil dihapus dan stok dikembalikan.');
            }
        } elseif (count($this->hapus_selected_id) > 0) {
            foreach ($this->hapus_selected_id as $id) {
                $penjualan = Penjualan::find($id);
                if ($penjualan) {
                    $produk = $penjualan->produk;
                    if ($produk) {
                        $produk->stok += $penjualan->jumlah;
                        $produk->save();
                    }
                    $penjualan->delete();
                }
            }
            session()->flash('pesan', count($this->hapus_selected_id) . ' Data Penjualan berhasil dihapus dan stok dikembalikan.');
        }

        $this->penjualan_id_to_delete = null;
        $this->hapus_selected_id = [];
        $this->select_all = false;
        $this->resetPage();
        $this->dispatch('penjualanUpdated');
        $this->dispatch('produkUpdated'); 
    }

    
    public function calculateTotalPenjualanHarian()
    {
        $today = Carbon::today()->toDateString();

        $this->totalPenjualanHarian = Penjualan::where('tanggal', $today)->sum('jumlah');
        
    }

    public function refreshData()
    {
        $this->resetPage();
        $this->calculateTotalPenjualanHarian();
    }

    public function render()
    {
       

        $data = Penjualan::with('produk');

        if ($this->katakunci) {
            $data->where(function ($query) {
                $query->where('jumlah', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('tanggal', 'like', '%' . $this->katakunci . '%')
                      ->orWhereHas('produk', function ($q) {
                          $q->where('nama', 'like', '%' . $this->katakunci . '%');
                      });
            });
        }

        $data->orderBy($this->sortcolum, $this->sortarah);

        $dataPenjualans = $data->paginate(5);

        return view('livewire.penjualan-table', [
            'dataPenjualans' => $dataPenjualans,
        ]);
    }
}