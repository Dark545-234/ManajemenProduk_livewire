@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">List Produk</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                @livewire('produk-form')
            </div>
        </div>
        <div>
            @livewire('produk-table')    
        </div>
    </div>
@endsection