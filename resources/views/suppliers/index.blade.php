@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush

@section('content')
    <div class="container">
       
        <h1 class="mb-4">Supplier List</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                @livewire('supplier-form')
            </div>
        </div>
        <div>
            @livewire('supplier-table')    
        </div>
    </div>
@endsection