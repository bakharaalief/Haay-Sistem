@extends('layouts.admin.app')

@section('page-name')
<h1>Dashboard</h1>
@endsection

@section('content')

<!-- row 1 -->
<div class="row">

    {{-- total order box --}}
    <div class="col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Semua Pesanan</span>
            <span class="info-box-number">
              {{ count($dataOrderAll) }}
            </span>
          </div>
        </div>
    </div>

    {{-- transaksi berhasil box --}}
    <div class="col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fa fa-smile-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Semua Pesanan Berhasil</span>
            <span class="info-box-number">
              {{ count($dataOrderSuccess) }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    {{-- transaksi gagal box --}}
    <div class="col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-frown-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Semua Pemesanan Dibatalkan</span>
            <span class="info-box-number">
              {{ count($dataOrderCanceled) }}
            </span>
          </div>
        </div>
    </div>

    {{-- member box --}}
    <div class="col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Pelanggan</span>
            <span class="info-box-number">{{ count($dataCustomer) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>

<!-- Row 2 tentang grafik order per tahun -->
<div class="row my-3">
  <div class="col-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Grafik Pesanan Tahun Ini</h3>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- row 4 tentang user --}}
<div class="row my-2">

  {{-- pelanggan gender --}}
  <div class="col-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Pelanggan Gender</h3>
      </div>
      <div class="card-body">
        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection

@section('js')
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

{{-- info data js --}}
<script>
  $(function () {

    //getData from php
    var dataOrderThisYear = JSON.parse("{{ json_encode($dataOrderThisYearPerBulan) }}");
    var dataOrderSuccessThisYear = JSON.parse("{{ json_encode($dataOrderSuccessThisYearPerBulan) }}");
    var dataOrderFailedThisYear = JSON.parse("{{ json_encode($dataOrderFailedThisYearPerBulan) }}");

    var areaChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Agus', 'Sept', 'Okt', 'Nov', 'Des'],
      datasets: [
        {
          label               : 'Pesanan Berhasil',
          backgroundColor     : 'rgba(8, 166, 42, 0.9)',
          borderColor         : 'rgba(8, 166, 42, 0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(8, 166, 42, 1)',
          pointStrokeColor    : '#08a62a',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(8, 166, 42, 1)',
          data                : dataOrderSuccessThisYear
        },
        {
          label               : 'Seluruh Pesanan',
          backgroundColor     : 'rgba(158, 8, 166, 0.9)',
          borderColor         : 'rgba(158, 8, 166, 0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(158, 8, 166, 1)',
          pointStrokeColor    : '#9e08a6',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(158, 8, 166,1)',
          data                : dataOrderThisYear 
        },
        {
          label               : 'Pesanan Dibatalkan',
          backgroundColor     : 'rgba(191, 13, 28, 0.9)',
          borderColor         : 'rgba(191, 13, 28, 0.8)',
          pointRadius          : false,
          pointColor          : '#bf0d1c',
          pointStrokeColor    : 'rgba(191, 13, 28, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(191, 13, 28, 1)',
          data                : dataOrderFailedThisYear
        },
      ]
    }

    //-------------
    //- order CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  })

  //- gender CHART -
  //-------------
  var customerGender = JSON.parse("{{ json_encode($customerGender) }}");

  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData        = {
    labels: [
        'Laki',
        'Perempuan'
    ],
    datasets: [
      {
        data: customerGender,
        backgroundColor : ['#f56954', '#00a65a'],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
</script>
@endSection
