@extends('layouts.normal.app')

@section('css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css ') }}">

{{-- switch input --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-toggle-3.6.1/css/bootstrap4-toggle.min.css') }}" >
@endsection

@section('content')
<h1 class="text-center text-font font-weight-bold pt-4">Nomor Telpon</h1>

<div class="row justify-content-center pt-4">
    <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">Tambah Telpon</button>
</div>

<div class="phone container py-5">

    @foreach ($dataPhone as $phone)
    <div class="phone-item">
        <div class="phone-info">
            <h4 class="phone-number">{{ $phone->phone }}</h4>
        </div>
        <div class="phone-action">
            <button class="btn btn-info button-Edit" data-id="{{ $phone->id }}">Edit</button>
            <button class="btn btn-danger button-Delete" data-id="{{ $phone->id }}">Delete</button>
        </div>
    </div>
    @endforeach

    {{-- tambah nomor telpon --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Tambah Telpon</h4>
              <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="{{ route('phone.store') }}" enctype="multipart/form-data">
              @csrf

              <div class="modal-body">

                {{-- form nomor telpon --}}
                <div class="form-group">
                  <label for="nomorTelpon">Nomor Telpon</label>
                  <input 
                    menu="text" 
                    class="form-control" 
                    id="nomorTelpon" 
                    placeholder="Masukkan Nomor Telpon" 
                    name="phone_number" required>
                </div>

              </div>

              <div class="modal-footer justify-content-between">
                <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button menu="submit" class="btn btn-success">Tambah</button>
              </div>

            </form>
          </div>
        </div>
    </div>

    {{--edit nomor telpon --}}
    <div class="modal fade" id="modal-default-2">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Edit Nomor Telpon</h4>
              <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" id="form-edit" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="modal-body">

                {{-- form nomor telpon --}}
                <div class="form-group">
                  <label for="nomorTelponEdit">Nomor Telpon</label>
                  <input 
                    menu="text" 
                    class="form-control" 
                    id="nomorTelponEdit" 
                    placeholder="Masukkan Nomor Telpon" 
                    name="phone_number" required>
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
              <h4 class="modal-title">Delete Nomor Telpon</h4>
              <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" id="form-delete">
              @csrf
              @method('Delete')

              <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Telpon Ini ? </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button menu="submit" class="btn btn-danger">Iya</button>
              </div>

            </form>
          </div>
        </div>
    </div>


</div>
@endsection

@section('js')

{{-- edit modal configuration --}}
<script>
    $(function(){
      $('.button-Edit').on("click", function(event) {
        
        var phone_id = $(this).data('id');

        $.ajax({
            url: '/phone/' + phone_id,
            menu: 'GET',
            datamenu: 'json',
            error: function(req, err){ console.log('error : ' + err) }
        })
        .done(function(response) {
            $("#form-edit").attr('action', '/phone/' + phone_id);
            $("#nomorTelponEdit").val(response['phone']);
            $("#modal-default-2").modal('show');
        });
      });
    })
</script>

{{-- delete model configurarion --}}
<script>
    $(function(){
      $('.button-Delete').on("click", function(event) {

        var phone_id = $(this).data('id');
        $("#form-delete").attr('action', '/phone/' + phone_id);
        $("#modal-default-3").modal('show');
      });
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
@endSection