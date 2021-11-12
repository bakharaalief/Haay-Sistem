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
<h1>Level</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title">Data Table Level</h3>

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
                <th>Jenis Level</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataLevel as $level)
              <tr>
                <td>{{ $level->level }}</td>
                <td>
                  <button class="btn btn-warning edit-level" data-toggle="modal" data-id="{{$level->id}}">
                  Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger delete-level" data-toggle="modal" data-id="{{$level->id}}">
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
                <h4 class="modal-title">Tambah Level</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('level.store') }}">
                @csrf

                <div class="modal-body">
                  {{-- form name level --}}
                  <div class="form-group">
                    <label for="levelName">Nama Level</label>
                    <input type="text" class="form-control" id="levelName" placeholder="Nama Level" name="level" required>
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
                <h4 class="modal-title">Edit Level</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  <div class="form-group">
                    <label for="levelName">Nama Level</label>
                    <input type="text" class="form-control" id="levelNameEdit" placeholder="Nama Level" name="level" required>
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
                <h4 class="modal-title">Delete Level</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-delete">
                @csrf
                @method('Delete')

                <div class="modal-body">
                  <p>Anda Yakin Ingin Menghapus Level Ini ? </p>
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

{{-- edit modal configuration --}}
<script>
  $(function(){
    $('.edit-level').on("click", function(event) {

      var level_id = $(this).data('id');
      $.ajax({
          url: '/admin/level/' + level_id,
          type: 'GET',
          dataType: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
          $("#modal-default-2").modal('show');
          $("#form-edit").attr('action', '/admin/level/' + level_id);
          $("#levelNameEdit").val(response['level']);
      });
    });
  })
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('.delete-level').on("click", function(event) {
  
      $("#modal-default-3").modal('show');
      var level_id = $(this).data('id');
      $("#form-delete").attr('action', '/admin/level/' + level_id);
    });
  })
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah level--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal tambah level--}}
@if ($message = Session::get('failed_store'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil update level--}}
@if ($message = Session::get('success_update'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal update level--}}
@if ($message = Session::get('failed_update'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif

{{-- berhasil delete level--}}
@if ($message = Session::get('success_delete'))
  <script>
     toastr.success('{{ $message }}');
  </script>
@endif

{{-- gagal delete level--}}
@if ($message = Session::get('failed_delete'))
  <script>
    toastr.error('{{ $message }}');
  </script>
@endif


@endsection