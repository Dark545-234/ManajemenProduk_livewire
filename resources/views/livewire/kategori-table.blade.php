<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3 pt-3 d-flex justify-content-between align-items-center">
            <input type="text" class="form-control w-25" wire:model.live="katakunci" placeholder="Cari kategori...">
            @if (count($hapus_selected_id) > 0)
               <a wire:click="delete_confirmation('')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus {{ count($hapus_selected_id) }} Data</a>
            @endif
        </div>

        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if (session()->has('pesan'))
            <div class="pt-3">
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
            </div>
        @endif

        
        <table class="table table-striped table-sortable">
            <thead>
                <tr>
                    <th><input type="checkbox" wire:model.live="select_all"></th>
                    <th class="col-md-1">No</th>
                    <th class="col-md-9 sort @if ($sortcolum == 'nama'){{ $sortarah }} @endif" wire:click="sort('nama')">Nama Kategori</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataKategoris as $key => $value)
                    <tr>
                        <td><input type="checkbox" wire:key="{{ $value->id }}" value="{{ $value->id }}" wire:model.live="hapus_selected_id"></td>
                        <td>{{ $dataKategoris->firstItem()+$key }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>
                            <a wire:click="triggerEdit({{ $value->id }})" class="btn btn-warning btn-sm">Edit</a>
                            <a wire:click="delete_confirmation({{ $value->id }})" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Del</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data kategori ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $dataKategoris->links() }}

        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" wire:click="delete()" data-bs-dismiss="modal">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>