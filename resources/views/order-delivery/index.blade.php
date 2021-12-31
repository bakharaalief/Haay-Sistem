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
<h1>Kurir</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title pr-auto">Data Table Kurir</h3>

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
                <th>Kurir</th>
                <th class="col-1">Status</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataOrderDelivery as $orderDelivery)
              <tr>
                <td>{{ $orderDelivery->delivery }}</td>
                <td>
                  <input 
                    class="visible-toogle"
                    type="checkbox" 
                    data-toggle="toggle" 
                    data-onstyle="outline-primary" 
                    data-offstyle="outline-secondary" 
                    data-width="100"
                    data-on="Aktif" 
                    data-off="Mati"
                    data-id="{{$orderDelivery->id}}"
                    value="{{$orderDelivery->delivery}}"

                    @if ($orderDelivery->visible) checked @endif>
                </td>
                <td>
                  <button class="btn btn-warning edit-order-delivery" data-toggle="modal" data-id="{{$orderDelivery->id}}">
                  Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger delete-order-delivery" data-toggle="modal" data-id="{{$orderDelivery->id}}">
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
                <h4 class="modal-title">Tambah Kurir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('order-delivery.store') }}">
                @csrf

                <div class="modal-body">
                  {{-- form name orderDelivery --}}
                  <div class="form-group">
                    <label for="deliveryName">Nama Kurir</label>
                    <input type="text" class="form-control" id="deliveryName" placeholder="Masukkan Nama Kurir" name="delivery" required>
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
                <h4 class="modal-title">Edit Kurir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  <div class="form-group">
                    <label for="deliveryNameEdit">Nama Kategori</label>
                    <input type="text" class="form-control" id="deliveryNameEdit" placeholder="Masukkan Nama Kurir" name="delivery" required>
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
                <h4 class="modal-title">Delete Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-delete">
                @csrf
                @method('Delete')

                <div class="modal-body">
                  <p>Anda Yakin Ingin Menghapus Kurir Ini ? </p>
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

{{-- toogle js --}}
<script src="{{ asset('assets/plugins/bootstrap4-toggle-3.6.1/js/bootstrap4-toggle.min.js') }}"></script>

{{-- visible button configuration --}}
<script>
  $(function(){
    $('.visible-toogle').change(function(){
      var status = $(this).prop('checked') == true ? 1 : 0;
      var delivery = $(this).data('id');

      $.ajax({
            url: '/admin/order-delivery/' + delivery + '/change-visible',
            type: 'PUT',
            dataType: 'text',
            data : {
              delivery_id  : delivery,
              delivery_visible : status, 
              _token: "{{ csrf_token() }}"
            },
            // encode : true,
            error: function(req, err){ 
              toastr.error('Gagal Update Status');
            },
            success: function(data) {
              if(data == 'berhasil update')  toastr.success('Berhasil Update Status');
              else toastr.error('Gagal Update Status');
            }
        })
    })
  })
</script>

{{-- edit modal configuration --}}
<script>
  $(function(){
    $('.edit-order-delivery').on("click", function(event) {

      var delivery_id = $(this).data('id');
      $.ajax({
          url: '/admin/order-delivery/' + delivery_id,
          type: 'GET',
          dataType: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
          $("#form-edit").attr('action', '/admin/order-delivery/' + delivery_id);
          $("#deliveryNameEdit").val(response['delivery']);
          $("#modal-default-2").modal('show');
      });
    });
  })
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('.delete-order-delivery').on("click", function(event) {

        var delivery_id = $(this).data('id');
        $("#form-delete").attr('action', '/admin/order-delivery/' + delivery_id);

        $("#modal-default-3").modal('show');
    });
  })
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah orderDelivery--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal tambah orderDelivery--}}
@if ($message = Session::get('failed_store'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil update orderDelivery--}}
@if ($message = Session::get('success_update'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal update orderDelivery--}}
@if ($message = Session::get('failed_update'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil delete orderDelivery--}}
@if ($message = Session::get('success_delete'))
  <script>
     toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal delete orderDelivery--}}
@if ($message = Session::get('failed_delete'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

@endsection