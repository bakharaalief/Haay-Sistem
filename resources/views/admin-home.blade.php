@extends('layouts.admin.app')

@section('page-name')
<h1>Dashboard</h1>
@endsection

@section('content')

<!-- Info boxes -->
<div class="row">

    {{-- transaksi box --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Transaksi</span>
            <span class="info-box-number">
              10.000
            </span>
          </div>
        </div>
    </div>

    {{-- transaksi berhasil box --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fa fa-smile-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Transaksi Berhasil</span>
            <span class="info-box-number">760</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    {{-- order box --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fa fa-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Pemasukan</span>
            <span class="info-box-number">
              Rp. 1.000.000
            </span>
          </div>
        </div>
    </div>

    {{-- new member box --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Customer</span>
            <span class="info-box-number">2,000</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>


@endsection
