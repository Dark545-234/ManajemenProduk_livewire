<?php

namespace App\Livewire;

use App\Models\stok_log; 
use Livewire\Component;
use Livewire\WithPagination;

class StoklogTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $katakunci;
    public $sortcolum = 'tanggal';
    public $sortarah = 'desc';
    public $hapus_selected_id = [];
    public $stok_log_id_to_delete;
    public $select_all = false;

    protected $listeners = ['stokLogUpdated' => '$refresh'];

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
            // Menggunakan stok_log::pluck()
            $this->hapus_selected_id = stok_log::pluck('id')->toArray();
        } else {
            $this->hapus_selected_id = [];
        }
    }

    public function delete_confirmation($id = '')
    {
        if ($id != '') {
            $this->stok_log_id_to_delete = $id;
            $this->hapus_selected_id = [];
        } else {
            $this->stok_log_id_to_delete = null;
        }
    }

    public function delete()
    {
        if ($this->stok_log_id_to_delete) {
            $deletedCount = stok_log::destroy($this->stok_log_id_to_delete); 
            if ($deletedCount > 0) {
                session()->flash('pesan', 'Data Log Stok berhasil dihapus.');
            } else {
                session()->flash('pesan_error', 'Gagal menghapus data Log Stok.');
            }
        } elseif (count($this->hapus_selected_id) > 0) {
            $deletedCount = stok_log::whereIn('id', $this->hapus_selected_id)->delete(); 
            if ($deletedCount > 0) {
                session()->flash('pesan', $deletedCount . ' Data Log Stok berhasil dihapus.');
            } else {
                session()->flash('pesan_error', 'Gagal menghapus data Log Stok yang dipilih.');
            }
        } else {
            session()->flash('pesan_error', 'Tidak ada data Log Stok yang dipilih untuk dihapus.');
        }

        $this->stok_log_id_to_delete = null;
        $this->hapus_selected_id = [];
        $this->select_all = false;
        $this->resetPage();
        $this->dispatch('stokLogUpdated');
    }

    public function render()
    {
        $data = stok_log::with('produk'); 

        if ($this->katakunci) {
            $data->where(function ($query) {
                $query->where('jenis', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('jumlah', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('tanggal', 'like', '%' . $this->katakunci . '%')
                      ->orWhereHas('produk', function ($q) {
                          $q->where('nama', 'like', '%' . $this->katakunci . '%');
                      });
            });
        }

        $data->orderBy($this->sortcolum, $this->sortarah);

        $dataStokLogs = $data->paginate(5);

        return view('livewire.stoklog-table', [
            'dataStokLogs' => $dataStokLogs,
        ]);
    }
}