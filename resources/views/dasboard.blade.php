@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush

@section('content')

    <div class="container">
        <div>
            @livewire('penjualan-table')    
        </div>
        <div>
            @livewire('stoklog-table')    
        </div>
        <div>
            @livewire('produk-table')    
        </div>
    </div>
@endsection