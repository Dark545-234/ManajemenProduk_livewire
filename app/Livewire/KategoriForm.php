<?php

namespace App\Livewire;

use App\Models\Kategori; 
use Livewire\Component;
use Illuminate\Validation\Rule;

class KategoriForm extends Component
{
    public $kategori_id; 
    public $nama;
    
    public $updateData = false;

    protected $listeners = ['editKategori' => 'edit'];

    protected function rules()
    {
        return [
            'nama' => [
                'required',
                'min:3',
                
                Rule::unique('kategoris', 'nama')->ignore($this->kategori_id), 
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama kategori wajib diisi.', 
        'nama.min' => 'Nama kategori minimal 3 karakter.', 
        'nama.unique' => 'Nama kategori ini sudah terdaftar.', 
        
    ];

    public function simpan()
    {
        $validatedData = $this->validate();

        Kategori::create($validatedData); 

        session()->flash('pesan', 'Data Kategori berhasil ditambahkan.'); 
        $this->clear();
        $this->dispatch('kategoriUpdated'); 
    }

    public function edit($id)
    {
        $data = Kategori::find($id); 
        if ($data) {
            $this->kategori_id = $data->id; 
            $this->nama = $data->nama;
            
            $this->updateData = true;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        $data = Kategori::find($this->kategori_id); 
        if ($data) {
            $data->update($validatedData);
            session()->flash('pesan', 'Data Kategori berhasil diperbarui.'); 
            $this->clear();
            $this->dispatch('kategoriUpdated'); 
        }
    }

    public function clear()
    {
        $this->reset(['nama', 'kategori_id', 'updateData']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.kategori-form');
    }
}