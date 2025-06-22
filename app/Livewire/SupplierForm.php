<?php

namespace App\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Illuminate\Validation\Rule;

class SupplierForm extends Component
{
    public $supplier_id;
    public $nama;
    public $alamat;
    public $telepon;
    public $updateData = false;

    protected $listeners = ['editSupplier' => 'edit'];
    // ---------------------------------------

    protected function rules()
    {
        return [
            'nama' => 'required|min:3',
            'alamat' => 'required',
            'telepon' => [
                'required',
                'numeric',
                'digits_between:10,15',
                Rule::unique('suppliers', 'telepon')->ignore($this->supplier_id),
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama supplier wajib diisi.',
        'nama.min' => 'Nama supplier minimal 3 karakter.',
        'alamat.required' => 'Alamat supplier wajib diisi.',
        'telepon.required' => 'Nomor telepon wajib diisi.',
        'telepon.numeric' => 'Nomor telepon harus berupa angka.',
        'telepon.digits_between' => 'Nomor telepon harus antara 10 sampai 15 digit.',
        'telepon.unique' => 'Nomor telepon ini sudah terdaftar.',
    ];

    public function simpan()
    {
        $validatedData = $this->validate();

        Supplier::create($validatedData);

        session()->flash('pesan', 'Data Supplier berhasil ditambahkan.');
        $this->clear();
        $this->dispatch('supplierUpdated');
    }

    public function edit($id) 
    {
        $data = Supplier::find($id);
        if ($data) {
            $this->supplier_id = $data->id;
            $this->nama = $data->nama;
            $this->alamat = $data->alamat;
            $this->telepon = $data->telepon;
            $this->updateData = true;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        $data = Supplier::find($this->supplier_id);
        if ($data) {
            $data->update($validatedData);
            session()->flash('pesan', 'Data Supplier berhasil diperbarui.');
            $this->clear();
            $this->dispatch('supplierUpdated');
        }
    }

    public function clear()
    {
        $this->reset(['nama', 'alamat', 'telepon', 'supplier_id', 'updateData']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.supplier-form');
    }
}