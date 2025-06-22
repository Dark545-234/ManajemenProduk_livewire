@extends('layouts.app')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">List Produk</h1>
        
        <div>
            @livewire('auth.login')    
        </div>
    </div>
@endsection