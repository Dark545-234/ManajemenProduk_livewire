<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h1 class="mb-4 text-center">Toko Kami</h1>

        @if (session()->has('shop_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('shop_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('shop_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('shop_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="Cari produk...">
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($produks as $produk)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text text-muted mb-1">Kategori: {{ $produk->kategori->nama ?? 'N/A' }}</p>
                            <p class="card-text text-muted mb-3">Supplier: {{ $produk->supplier->nama ?? 'N/A' }}</p>
                            <h4 class="card-subtitle mb-2 text-primary">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>
                            <p class="card-text text-success mb-3">Stok Tersedia: {{ $produk->stok }}</p>
                            
                            <div class="mt-auto"> 
                                @if ($produk->stok > 0)
                                    <button wire:click="buyProduct({{ $produk->id }}, 1)" class="btn btn-primary w-100">Beli (1 Unit)</button>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        Tidak ada produk yang tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $produks->links() }}
        </div>
    </div>
</div>