<?php

namespace App\Livewire;

use App\Models\Kategori; 
use Livewire\Component;
use Livewire\WithPagination;

class KategoriTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $katakunci;
    public $sortcolum = 'nama'; 
    public $sortarah = 'asc';
    public $hapus_selected_id = [];
    public $kategori_id_to_delete; 
    public $select_all = false;

    protected $listeners = ['kategoriUpdated' => '$refresh']; 

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
            $this->hapus_selected_id = Kategori::pluck('id')->toArray();
        } else {
            $this->hapus_selected_id = [];
        }
    }

    public function delete_confirmation($id = '')
    {
        if ($id != '') {
            $this->kategori_id_to_delete = $id; 
            $this->hapus_selected_id = []; 
        } else {
            $this->kategori_id_to_delete = null; 
        }
    }

    public function delete()
    {
        if ($this->kategori_id_to_delete) {
            // Hapus single kategori
            Kategori::destroy($this->kategori_id_to_delete);
            session()->flash('pesan', 'Data Kategori berhasil dihapus.');
        } elseif (count($this->hapus_selected_id) > 0) {
            // Hapus multiple kategori
            Kategori::whereIn('id', $this->hapus_selected_id)->delete();
            session()->flash('pesan', count($this->hapus_selected_id) . ' Data Kategori berhasil dihapus.');
        }

        $this->kategori_id_to_delete = null; 
        $this->hapus_selected_id = []; 
        $this->select_all = false; 
        $this->resetPage(); 
    }

    public function triggerEdit($id)
    {
        $this->dispatch('editKategori', $id);
    }

    public function render()
    {
        $data = Kategori::query();

        
        if ($this->katakunci) {
            $data->where('nama', 'like', '%' . $this->katakunci . '%');
        }

        
        $data->orderBy($this->sortcolum, $this->sortarah);

        
        $dataKategoris = $data->paginate(5); 

        return view('livewire.kategori-table', [
            'dataKategoris' => $dataKategoris, 
        ]);
    }
}