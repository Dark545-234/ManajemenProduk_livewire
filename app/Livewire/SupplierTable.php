<?php

namespace App\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $katakunci;
    public $sortcolum = 'nama';
    public $sortarah = 'asc';
    public $hapus_selected_id = [];
    public $produk_id_to_delete;
    public $select_all = false;

    protected $listeners = ['supplierUpdated' => '$refresh'];

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
            $this->hapus_selected_id = Supplier::pluck('id')->toArray();
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
            Supplier::destroy($this->produk_id_to_delete);
            session()->flash('pesan', 'Data Supplier berhasil dihapus.');
        } elseif (count($this->hapus_selected_id) > 0) {
            Supplier::whereIn('id', $this->hapus_selected_id)->delete();
            session()->flash('pesan', count($this->hapus_selected_id) . ' Data Supplier berhasil dihapus.');
        }

        $this->produk_id_to_delete = null;
        $this->hapus_selected_id = [];
        $this->select_all = false;
        $this->resetPage();
    }

    public function triggerEdit($id)
    {
        $this->dispatch('editSupplier', $id);
    }
    // ---------------------------

    public function render()
    {
        $data = Supplier::query();

        if ($this->katakunci) {
            $data->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('alamat', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('telepon', 'like', '%' . $this->katakunci . '%');
            });
        }

        $data->orderBy($this->sortcolum, $this->sortarah);

        $dataProduks = $data->paginate(5);

        return view('livewire.supplier-table', [
            'dataProduks' => $dataProduks,
        ]);
    }
}