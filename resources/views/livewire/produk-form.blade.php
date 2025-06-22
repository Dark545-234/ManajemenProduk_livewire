<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-3">{{ $updateData ? 'Edit Produk' : 'Tambah Produk Baru' }}</h3>
        <form wire:submit.prevent="{{ $updateData ? 'update' : 'simpan' }}">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" id="nama" class="form-control" wire:model.live="nama" placeholder="Masukkan Nama Produk">
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" id="harga" class="form-control" wire:model.live="harga" placeholder="Masukkan Harga Produk">
                    @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" id="stok" class="form-control" wire:model.live="stok" placeholder="Masukkan Jumlah Stok">
                    @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                    <select id="supplier_id" class="form-select" wire:model.live="supplier_id">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select id="kategori_id" class="form-select" wire:model.live="kategori_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">
                        {{ $updateData ? 'UPDATE' : 'SIMPAN' }}
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="clear()">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>