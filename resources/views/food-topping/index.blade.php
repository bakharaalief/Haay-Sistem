@extends('layouts.admin.app')

@section('css')
{{-- datatables --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css ') }}">
@endsection

@section('page-name')
<h1>Tooping</h1>
@endsection

@php
  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka, 0,',','.');
    return $hasil_rupiah;
  }
@endphp

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title pr-auto">Data Table Tooping</h3>

          <div class="card-tools">
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus pr-1" aria-hidden="true"></i>
              Tambah
            </button>
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tooping</th>
                <th class="col-3">Harga</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataFoodTopping as $foodTopping)
              <tr>
                <td>{{ $foodTopping->topping }}</td>
                <td>{{ rupiah($foodTopping->price) }}</td>
                <td>
                  <button class="btn btn-warning edit-food-topping" data-toggle="modal" data-id="{{$foodTopping->id}}">
                  Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger delete-food-topping" data-toggle="modal" data-id="{{$foodTopping->id}}">
                    Delete
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- tambah modal --}}
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Tooping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('food-topping.store') }}">
                @csrf

                <div class="modal-body">
                  {{-- form name foodTopping --}}
                  <div class="form-group">
                    <label for="toppingName">Nama Tooping</label>
                    <input type="text" class="form-control" id="toppingName" placeholder="Nama Tooping" name="topping" required>
                  </div>

                  {{-- form price foodTopping --}}
                  <div class="form-group">
                    <label for="toppingName">Harga Tooping</label>
                    <input type="text" class="form-control" id="toppingPrice" placeholder="Harga Tooping" name="price" required>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- edit modal --}}
        <div class="modal fade" id="modal-default-2">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Edit Tooping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  <div class="form-group">
                    <label for="toppingName">Nama Tooping</label>
                    <input type="text" class="form-control" id="toppingNameEdit" placeholder="Nama Tooping" name="topping" required>
                  </div>

                  {{-- form price foodTopping --}}
                  <div class="form-group">
                    <label for="toppingName">Harga Tooping</label>
                    <input type="text" class="form-control" id="toppingPriceEdit" placeholder="Harga Tooping" name="price" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- delete modal --}}
        <div class="modal fade" id="modal-default-3">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Delete Tooping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-delete">
                @csrf
                @method('Delete')

                <div class="modal-body">
                  <p>Anda Yakin Ingin Menghapus Tooping Ini ? </p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Iya</button>
                </div>

              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('js')
{{-- datatables --}}
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

{{-- datatable configuration --}}
<script>
  $(function () {
    $("#example1")
      .DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "searching": false,
        "ordering": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      })
      .buttons()
      .container()
      .appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

{{-- Rupiah input configuration --}}
<script>
function formatRupiah(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

$(function(){
  $('#toppingPrice').keyup(function(){
    var num = $('#toppingPrice').val()
    var hasil = formatRupiah(num, "Rp. ");
    $('#toppingPrice').val(hasil);
  });

  $('#toppingPriceEdit').keyup(function(){
    var num = $('#toppingPriceEdit').val()
    var hasil = formatRupiah(num, "Rp. ");
    $('#toppingPriceEdit').val(hasil);
  });
});
</script>

{{-- edit modal configuration --}}
<script>
$(function(){
  $('.edit-food-topping').on("click", function(event) {

    var food_topping_id = $(this).data('id');
    $.ajax({
        url: '/admin/food-topping/' + food_topping_id,
        type: 'GET',
        dataType: 'json',
        error: function(req, err){ console.log('error : ' + err) }
    })
    .done(function(response) {
        $("#modal-default-2").modal('show');
        $("#form-edit").attr('action', '/admin/food-topping/' + food_topping_id);
        $("#toppingNameEdit").val(response['topping']);

        var hasil = formatRupiah(response['price'].toString(), "Rp. ");
        $("#toppingPriceEdit").val(hasil);
    });
  });
})
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('.delete-food-topping').on("click", function(event) {
  
      $("#modal-default-3").modal('show');
      var food_topping_id = $(this).data('id');
      $("#form-delete").attr('action', '/admin/food-topping/' + food_topping_id);
    });
  })
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah foodTopping--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal tambah foodTopping--}}
@if ($message = Session::get('failed_store'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil update foodTopping--}}
@if ($message = Session::get('success_update'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal update foodTopping--}}
@if ($message = Session::get('failed_update'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil delete foodTopping--}}
@if ($message = Session::get('success_delete'))
  <script>
     toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal delete foodTopping--}}
@if ($message = Session::get('failed_delete'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

@endsection