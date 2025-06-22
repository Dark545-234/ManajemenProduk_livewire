<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ \Carbon\Carbon::today()->format('d M Y') }}</h5>
                        <p class="card-text fs-3">{{ $totalPenjualanHarian }} Unit</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-3 pt-3 d-flex justify-content-between align-items-center">
            <input type="text" class="form-control w-25" wire:model.live="katakunci" placeholder="Cari penjualan...">
            @if (count($hapus_selected_id ?? []) > 0)
               <a wire:click="delete_confirmation('')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus {{ count($hapus_selected_id) }} Data</a>
            @endif
        </div>

        @if (session()->has('pesan'))
            <div class="pt-3">
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
            </div>
        @endif
        @error('delete')
            <div class="pt-3">
                <div class="alert alert-danger">{{ $message }}</div>
            </div>
        @enderror

        
        <table class="table table-striped table-sortable">
            <thead>
                <tr>
                    <th><input type="checkbox" wire:model.live="select_all"></th>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4 sort @if ($sortcolum == 'produk_id'){{ $sortarah }} @endif" wire:click="sort('produk_id')">Nama Produk</th>
                    <th class="col-md-2 sort @if ($sortcolum == 'jumlah'){{ $sortarah }} @endif" wire:click="sort('jumlah')">Jumlah Terjual</th>
                    <th class="col-md-2 sort @if ($sortcolum == 'tanggal'){{ $sortarah }} @endif" wire:click="sort('tanggal')">Tanggal Penjualan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataPenjualans as $key => $value)
                    <tr>
                        <td><input type="checkbox" wire:key="{{ $value->id }}" value="{{ $value->id }}" wire:model.live="hapus_selected_id"></td>
                        <td>{{ $dataPenjualans->firstItem()+$key }}</td>
                        <td>{{ $value->produk->nama ?? '-' }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->tanggal)->format('d M Y') }}</td>
                        <td>
                            {{-- <a wire:click="triggerEdit({{ $value->id }})" class="btn btn-warning btn-sm">Edit</a> --}}
                            <a wire:click="delete_confirmation({{ $value->id }})" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Del</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data penjualan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $dataPenjualans->links() }}

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