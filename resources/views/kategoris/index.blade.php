@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">Data Kategori</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                @livewire('kategori-form')
            </div>
        </div>
        <div>
            @livewire('kategori-table')    
        </div>
    </div>
@endsection