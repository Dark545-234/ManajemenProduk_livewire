<?php

namespace App\Livewire;

use App\Models\Produk; 
use App\Models\Supplier; 
use App\Models\Kategori; 
use Livewire\Component;
use Illuminate\Validation\Rule;

class ProdukForm extends Component
{
    public $produk_id; 
    public $nama;
    public $harga; 
    public $stok;  
    public $supplier_id; 
    public $kategori_id; 
    public $updateData = false;

    protected $listeners = ['editProduk' => 'edit']; 

    protected function rules()
    {
        return [
            'nama' => [
                'required',
                'min:3',

            ],
            'harga' => 'required|numeric|min:0', 
            'stok' => 'required|integer|min:0',  
            'supplier_id' => 'required|exists:suppliers,id', 
            'kategori_id' => 'required|exists:kategoris,id', 
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama produk wajib diisi.',
        'nama.min' => 'Nama produk minimal 3 karakter.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'harga.min' => 'Harga tidak boleh negatif.',
        'stok.required' => 'Stok wajib diisi.',
        'stok.integer' => 'Stok harus berupa bilangan bulat.',
        'stok.min' => 'Stok tidak boleh negatif.',
        'supplier_id.required' => 'Supplier wajib dipilih.',
        'supplier_id.exists' => 'Supplier tidak valid.',
        'kategori_id.required' => 'Kategori wajib dipilih.',
        'kategori_id.exists' => 'Kategori tidak valid.',
    ];

    public function simpan()
    {
        $validatedData = $this->validate();

        Produk::create($validatedData); 

        session()->flash('pesan', 'Data Produk berhasil ditambahkan.');
        $this->clear();
        $this->dispatch('produkUpdated'); 
    }

    public function edit($id)
    {
        $data = Produk::find($id); 
        if ($data) {
            $this->produk_id = $data->id;
            $this->nama = $data->nama;
            $this->harga = $data->harga; 
            $this->stok = $data->stok;   
            $this->supplier_id = $data->supplier_id; 
            $this->kategori_id = $data->kategori_id; 
            $this->updateData = true;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        $data = Produk::find($this->produk_id); 
        if ($data) {
            $data->update($validatedData);
            session()->flash('pesan', 'Data Produk berhasil diperbarui.');
            $this->clear();
            $this->dispatch('produkUpdated'); 
        }
    }

    public function clear()
    {
        $this->reset(['nama', 'harga', 'stok', 'supplier_id', 'kategori_id', 'produk_id', 'updateData']);
        $this->resetValidation();
    }

    public function render()
    {
        $suppliers = Supplier::orderBy('nama')->get();
        $kategoris = Kategori::orderBy('nama')->get();

        return view('livewire.produk-form', [
            'suppliers' => $suppliers,
            'kategoris' => $kategoris,
        ]);
    }
}