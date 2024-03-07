@extends('dashboard-admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard House of Gauri</h1>
</div>    
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Dispensasi Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product }} Product</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Dispensasi Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $wedding }} Wedding</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Dispensasi Sakit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">... Event</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection