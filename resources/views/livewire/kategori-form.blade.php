<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-3">{{ $updateData ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h3>
        <form wire:submit.prevent="{{ $updateData ? 'update' : 'simpan' }}">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" id="nama" class="form-control" wire:model.live="nama" placeholder="Masukkan Nama Kategori">
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
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