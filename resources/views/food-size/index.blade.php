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
<h1>Size</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title pr-auto">Data Table size</h3>

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
                <th>size</th>
                <th class="col-1">Status</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataFoodSize as $foodSize)
              <tr>
                <td>{{ $foodSize->size }}</td>
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
                    data-id="{{$foodSize->id}}"
                    value="{{$foodSize->size}}"

                    @if ($foodSize->visible) checked @endif>
                </td>
                <td>
                  <button class="btn btn-warning edit-food-size" data-toggle="modal" data-id="{{$foodSize->id}}">
                  Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger delete-food-size" data-toggle="modal" data-id="{{$foodSize->id}}">
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
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('food-size.store') }}">
                @csrf

                <div class="modal-body">
                  {{-- form name foodsize --}}
                  <div class="form-group">
                    <label for="sizeName">Nama Kategori</label>
                    <input type="text" class="form-control" id="sizeName" placeholder="Nama Kategori" name="size" required>
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
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  <div class="form-group">
                    <label for="sizeName">Nama Kategori</label>
                    <input type="text" class="form-control" id="sizeNameEdit" placeholder="Nama Size" name="size" required>
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
                  <p>Anda Yakin Ingin Menghapus Kategori Ini ? </p>
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

{{-- toogle configuration --}}
<script>
$(function(){
  $('.visible-toogle').change(function(){
    var status = $(this).prop('checked') == true ? 1 : 0;
    var food_size_id = $(this).data('id');
    var food_size_val = $(this).val();

    $.ajax({
          url: '/admin/food-size/' + food_size_id + '/change-visible',
          type: 'PUT',
          // dataType: '',
          // data : {'visible' : status },
          // error: function(req, err){ 
          //   console.log('error : ' + err) 
          // },
          // success: function(data) {
          //   console.log(data);
          //   console.log('process sucess');
          // }
      })
  })
})
</script>

{{-- edit modal configuration --}}
<script>
  $(function(){
    $('.edit-food-size').on("click", function(event) {
      
      var food_size_id = $(this).data('id');
      $.ajax({
          url: '/admin/food-size/' + food_size_id,
          type: 'GET',
          dataType: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
          $("#modal-default-2").modal('show');
          $("#form-edit").attr('action', '/admin/food-size/' + food_size_id);
          $("#sizeNameEdit").val(response['size']);
      });
    });
  })
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('.delete-food-size').on("click", function(event) {

      $("#modal-default-3").modal('show');
      var food_size_id = $(this).data('id');
      $("#form-delete").attr('action', '/admin/food-size/' + food_size_id);
    });
  })
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah foodsize--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal tambah foodsize--}}
@if ($message = Session::get('failed_store'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil update foodsize--}}
@if ($message = Session::get('success_update'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal update foodsize--}}
@if ($message = Session::get('failed_update'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil delete foodsize--}}
@if ($message = Session::get('success_delete'))
  <script>
     toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal delete foodsize--}}
@if ($message = Session::get('failed_delete'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

@endsection