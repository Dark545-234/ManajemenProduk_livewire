<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="mb-3">{{ $updateData ? 'Edit Supplier' : 'Tambah Supplier Baru' }}</h3>
    <form>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" wire:model="nama" placeholder="Masukkan Nama Supplier">
                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" wire:model="alamat" placeholder="Masukkan Alamat Supplier">
                @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" wire:model="telepon" placeholder="Masukkan Nomor Telepon Supplier">
                @error('telepon') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                @if ($updateData == false)
                    <button type="button" class="btn btn-primary" wire:click="simpan()">SIMPAN</button>
                @else
                    <button type="button" class="btn btn-primary" wire:click="update()">UPDATE</button>
                @endif
                <button type="button" class="btn btn-secondary" wire:click="clear()">Reset</button>
            </div>
        </div>
    </form>
</div>
</div>
