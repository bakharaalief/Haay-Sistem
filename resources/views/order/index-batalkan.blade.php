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

{{-- switch input --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-toggle-3.6.1/css/bootstrap4-toggle.min.css') }}" >
@endsection

@section('page-name')
<h1>Pemesanan Batal</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title pr-auto">Data Pesanan</h3>

          <div class="card-tools">
            {{-- <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus pr-1" aria-hidden="true"></i>
              Tambah
            </button> --}}
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama User</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Lama Pengerjaan</th>
                <th>Kurir</th>
                <th>Bukti Transfer</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th class="col-1">Detail</th>
                <th class="col-1">Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataOrder as $order)
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->getUser->name}}</td>
                <td>{{ $order->getPhone->phone }}</td>
                <td>{{ $order->getAddress->address }}</td>
                <td>{{ $order->getOrderProcess->order_process_time }}</td>
                <td>{{ $order->getKurir->delivery }}</td>
                <td> null </td>
                {{--
                <td>
                  <img 
                    src="{{ asset('images/foto_menu/' . $foodMenu->link_image ) }}" 
                    class="img-thumbnail"
                    width="250"
                    height="250">
                </td> --}}
                <td>{{ $order->total_bayar }}</td>
                <td>{{ $order->getStatus->status }}</td>
                <td>
                  <button class="btn btn-info detail-order" data-toggle="modal" data-id="{{$order->id}}" >
                  Detail
                  </button>
                </td>
                <td>
                  <button class="btn btn-warning edit-order" data-toggle="modal" data-id="{{$order->id}}">
                  Edit
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- edit modal --}}
        <div class="modal fade" id="modal-default-2">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Edit Menu</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  {{-- form name food menu --}}
                  {{-- <div class="form-group">
                    <label for="orderNameEdit">Nama Menu</label>
                    <input menu="text" class="form-control" id="menuNameEdit" placeholder="Masukkan Nama Menu" name="menu_name" required>
                  </div> --}}

                  {{-- form category food menu --}}
                  <div class="form-group">
                    <label for="orderStatusEdit">Status</label>
                    <select class="form-control" id="orderStatusEdit" name="order_status">
                        @foreach ($dataStatus as $data)
                        <option value="{{ $data->id }}">{{ $data->status }}</option>
                        @endforeach
                    </select>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button menu="submit" class="btn btn-primary">Update</button>
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
                <h4 class="modal-title">Delete Menu</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-delete">
                @csrf
                @method('Delete')

                <div class="modal-body">
                  <p>Anda Yakin Ingin Menghapus Menu Ini ? </p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button menu="submit" class="btn btn-danger">Iya</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- detail modal --}}
        <div class="modal fade" id="modal-default-4">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modalDetailTitle">Kentaki</h4>
              </div>
              <div class="modal-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th>Kategori</th>
                      <th>Tipe</th>
                      <th>Jumlah</th>
                      <th>Harga Dibeli</th>
                      <th>Total Harga</th>
                    </tr>
                  </thead>
                  <tbody id="modalDetailTable">
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
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
        "searching": true,
        "ordering": true,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      })
      .buttons()
      .container()
      .appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

{{-- toogle js --}}
<script src="{{ asset('assets/plugins/bootstrap4-toggle-3.6.1/js/bootstrap4-toggle.min.js') }}"></script>

{{-- edit modal configuration --}}
<script>
  $(function(){
    $('body').on("click", '.edit-order', function(event) {
      
      var order_id = $(this).data('id');

      $.ajax({
          url: '/admin/order/' + order_id,
          menu: 'GET',
          datamenu: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
          $("#form-edit").attr('action', '/admin/order/' + order_id);
          $("#orderStatusEdit").val(response['order_status']);
          $("#modal-default-2").modal('show');
      });
    });
  })
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('body').on("click", '.delete-food-menu', function(event) {

      $("#modal-default-3").modal('show');
      var food_menu_id = $(this).data('id');
      $("#form-delete").attr('action', '/admin/food-menu/' + food_menu_id);
    });
  })
</script>

{{-- detail model configurarion --}}
<script>
  $(function(){

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

    $('body').on("click", '.detail-order', function(event) {

      var order_id = $(this).data('id');

      $.ajax({
          url: '/admin/order/' + order_id + '/order-detail',
          menu: 'GET',
          datamenu: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {

        console.log(response);
          $("#modalDetailTitle").text('id : ' + response['id']);

          $('#modalDetailTable').empty();

          //jika data lebih dari 0
          if(response['detail_order'].length > 0){
            var isiTable = '';
            $.each(response['detail_order'], function (i, item) {
              isiTable += 
                // '<tr><td>' + item.food_menu_name + '</td><td>' + item.content + '</td><td>' + item.UID + '</td></tr>';
                '<tr><td>' 
                  + item.food_menu_name + '</td><td>' 
                  + item.food_menu_category + '</td><td>' 
                  + item.food_menu_type + '</td><td>'
                  + item.amount + '</td><td>'
                  + formatRupiah(item.price_now.toString(), "Rp.") + '</td><td>'
                  + formatRupiah((item.price_now * item.amount).toString(), "Rp.") + 
                '</td></tr>';
            });
            $('#modalDetailTable').append(isiTable);
          }

          $("#modal-default-4").modal('show');
      });
    });
  })
</script>

{{-- auto change price to rupiah --}}
<script>
  $(function () {

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

    $("#menuPrice").keyup(function(){
      var hasil = formatRupiah($(this).val(), "Rp.");
      $(this).val(hasil)
    })
  })
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah foodmenu--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal tambah foodmenu--}}
@if ($message = Session::get('failed_store'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil update foodmenu--}}
@if ($message = Session::get('success_update'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal update foodmenu--}}
@if ($message = Session::get('failed_update'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil delete foodmenu--}}
@if ($message = Session::get('success_delete'))
  <script>
     toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal delete foodmenu--}}
@if ($message = Session::get('failed_delete'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

@endsection