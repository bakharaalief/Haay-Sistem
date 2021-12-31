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
<h1>Menu</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="card-title pr-auto">Data Table Menu</h3>

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
                <th>Nama</th>
                <th>Dekripsi</th>
                <th>Kategori</th>
                <th>Ukuran</th>
                <th>Photo</th>
                <th class="col-1">Status</th>
                <th>Detail</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataFoodMenu as $foodMenu)
              <tr>
                <td>{{ $foodMenu->name }}</td>
                <td>{{ $foodMenu->description }}</td>
                <td>{{ $foodMenu->getCategory->category }}</td>
                <td>{{ $foodMenu->getSize->size }}</td>
                <td>
                  {{-- <img 
                    src="{{ asset('images/foto_menu/' . $foodMenu->link_image ) }}" 
                    class="img-thumbnail"
                    width="250"
                    height="250"> --}}
                </td>
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
                    data-id="{{$foodMenu->id}}"
                    value="{{$foodMenu->name}}"

                    @if ($foodMenu->visible) checked @endif>
                </td>
                <td>
                  <button class="btn btn-info detail-food-menu" data-toggle="modal" data-id="{{$foodMenu->id}}" >
                  Detail
                  </button>
                </td>
                <td>
                  <button class="btn btn-warning edit-food-menu" data-toggle="modal" data-id="{{$foodMenu->id}}">
                  Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger delete-food-menu" data-toggle="modal" data-id="{{$foodMenu->id}}">
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
                <h4 class="modal-title">Tambah Menu</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('food-menu.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                  {{-- form name food menu --}}
                  <div class="form-group">
                    <label for="menuName">Nama Menu</label>
                    <input menu="text" class="form-control" id="menuName" placeholder="Masukkan Nama Menu" name="menu_name" required>
                  </div>

                  {{-- form deskripsi food menu --}}
                  <div class="form-group">
                    <label for="menuDescription">Deskripsi Menu</label>
                    <textarea class="form-control" id="menuDescription" name="menu_description" placeholder="Masukkan Deskripsi Menu" required></textarea>
                  </div>

                  {{-- form category food menu --}}
                  <div class="form-group">
                    <label for="menuCategory">Kategori Menu</label>
                    <select class="form-control" id="menuCategory" name="menu_category">
                        @foreach ($dataFoodCategory as $foodCategory)
                        <option value="{{ $foodCategory->id }}">{{ $foodCategory->category }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form category food size --}}
                  <div class="form-group">
                    <label for="menuSize">Size Menu</label>
                    <select class="form-control" id="menuSize" name="menu_size">
                        @foreach ($dataFoodSize as $foodSize)
                        <option value="{{ $foodSize->id }}">{{ $foodSize->size }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form photo food menu --}}
                  <div class="form-group">
                    <label for="menuPhoto">Foto Menu</label>
                    <input type="file" class="form-control-file" id="menuPhoto" name="menu_photo" required>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button menu="submit" class="btn btn-primary">Tambah</button>
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
                  <div class="form-group">
                    <label for="menuNameEdit">Nama Menu</label>
                    <input menu="text" class="form-control" id="menuNameEdit" placeholder="Masukkan Nama Menu" name="menu_name" required>
                  </div>

                  {{-- form deskripsi food menu --}}
                  <div class="form-group">
                    <label for="menuDescriptionEdit">Deskripsi Menu</label>
                    <textarea class="form-control" id="menuDescriptionEdit" name="menu_description" placeholder="Masukkan Deskripsi Menu" required></textarea>
                  </div>

                  {{-- form category food menu --}}
                  <div class="form-group">
                    <label for="menuCategoryEdit">Kategori Menu</label>
                    <select class="form-control" id="menuCategoryEdit" name="menu_category">
                        @foreach ($dataFoodCategory as $foodCategory)
                        <option value="{{ $foodCategory->id }}">{{ $foodCategory->category }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form category food size --}}
                  <div class="form-group">
                    <label for="menuSizeEdit">Size Menu</label>
                    <select class="form-control" id="menuSizeEdit" name="menu_size">
                        @foreach ($dataFoodSize as $foodSize)
                        <option value="{{ $foodSize->id }}">{{ $foodSize->size }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form photo food menu --}}
                  <div class="form-group">
                    <label for="menuPhotoEdit">Foto Menu</label>
                    <input type="file" class="form-control-file" id="menuPhotoEdit" name="menu_photo">
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
                      <th>Type</th>
                      <th>Harga</th>
                      <th class="col-1">Edit</th>
                      <th class="col-1">Delete</th>
                    </tr>
                  </thead>
                  <tbody id="modalDetailTable">
                  </tbody>
                </table>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button 
                  type="button" 
                  class="btn btn-success add-type-menu" 
                  data-toggle="modal" 
                  data-target="#modal-default-5">Tambah Tipe Menu</button>
              </div>
            </div>
          </div>
        </div>

        {{-- detail modal tambah --}}
        <div class="modal fade" id="modal-default-5">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Tipe Menu</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('food-menu-type.store') }}">
                @csrf

                <div class="modal-body">
                  {{-- form type food menu --}}
                  <div class="form-group">
                    <label for="menuType">Tipe Menu</label>
                    <select class="form-control" id="menuType" name="menu_type">
                        @foreach ($dataFoodType as $foodType)
                        <option value="{{ $foodType->id }}">{{ $foodType->type }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form price food menu --}}
                  <div class="form-group">
                    <label for="menuPrice">Harga Menu</label>
                    <input menu="text" class="form-control" id="menuPrice" placeholder="Masukkan Harga Menu" name="menu_price" required>
                  </div>

                  {{-- form menu id hidden --}}
                  <input type="text" class="form-control" id="menuIdType" name="menu_id">

                </div>
                <div class="modal-footer justify-content-between">
                  <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button menu="submit" class="btn btn-primary">Tambah</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- detail modal edit --}}
        <div class="modal fade" id="modal-default-6">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Edit Tipe</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-edit-type" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                  {{-- form type food menu --}}
                  <div class="form-group">
                    <label for="menuTypeEdit">Tipe Menu</label>
                    <select class="form-control" id="menuTypeEdit" name="menu_type">
                        @foreach ($dataFoodType as $foodType)
                        <option value="{{ $foodType->id }}">{{ $foodType->type }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{-- form price food menu --}}
                  <div class="form-group">
                    <label for="menuPriceEdit">Harga Menu</label>
                    <input type="text" class="form-control" id="menuPriceEdit" placeholder="Masukkan Harga Menu" name="menu_price" required>
                  </div>

                  {{-- form menu id hidden --}}
                  <input type="text" class="form-control" id="menuIdEditType" placeholder="Masukkan Harga Menu" name="menu_id" hidden>
                </div>
                <div class="modal-footer justify-content-between">
                  <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button menu="submit" class="btn btn-primary">Update</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- detail modal delete --}}
        <div class="modal fade" id="modal-default-7">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Delete Menu</h4>
                <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" id="form-delete-type">
                @csrf
                @method('Delete')

                <div class="modal-body">
                  <p>Anda Yakin Ingin Menghapus Type Ini ? </p>
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

{{-- visible button configuration --}}
<script>
  $(function(){
    $('.visible-toogle').change(function(){
      var status = $(this).prop('checked') == true ? 1 : 0;
      var food_menu_id = $(this).data('id');

      $.ajax({
            url: '/admin/food-menu/' + food_menu_id + '/change-visible',
            type: 'PUT',
            dataType: 'text',
            data : {
              menu_id  : food_menu_id,
              menu_visible : status, 
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
    $('.edit-food-menu').on("click", function(event) {
      
      var food_menu_id = $(this).data('id');
      $.ajax({
          url: '/admin/food-menu/' + food_menu_id,
          menu: 'GET',
          datamenu: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
          $("#modal-default-2").modal('show');
          $("#form-edit").attr('action', '/admin/food-menu/' + food_menu_id);
          $("#menuNameEdit").val(response['name']);
          $("#menuDescriptionEdit").val(response['description']);
          $("#menuCategoryEdit").val(response['food_category']);
          $("#menuSizeEdit").val(response['food_size']);
      });
    });
  })
</script>

{{-- delete model configurarion --}}
<script>
  $(function(){
    $('.delete-food-menu').on("click", function(event) {

      $("#modal-default-3").modal('show');
      var food_menu_id = $(this).data('id');
      $("#form-delete").attr('action', '/admin/food-menu/' + food_menu_id);
    });
  })
</script>

{{-- detail model configurarion --}}
<script>
  $(function(){
    $('.detail-food-menu').on("click", function(event) {

      var food_menu_id = $(this).data('id');

      $.ajax({
          url: '/admin/food-menu/' + food_menu_id + '/all-type',
          menu: 'GET',
          datamenu: 'json',
          error: function(req, err){ console.log('error : ' + err) }
      })
      .done(function(response) {
         
          $("#modalDetailTitle").text(response['name']);
          $('.add-type-menu').attr('data-id' , food_menu_id);
          $('#modalDetailTable').empty();

          //jika data lebih dari 0
          if(response['all_type'].length > 0){
            var isiTable = '';
            $.each(response['all_type'], function (i, item) {
              isiTable += 
                '<tr><td>' + 
                  item.type + '</td><td>' + 
                  item.pivot.price + '</td><td>' + 
                  '<button class="btn btn-warning edit-type-menu" data-toggle="modal" data-id="' + item.pivot.id + '">Edit</button></td><td>'+
                  '<button class="btn btn-danger delete-type-menu" data-toggle="modal" data-id="' + item.pivot.id + '">Delete</button>'+
                '</td></tr>';
            });
            $('#modalDetailTable').append(isiTable);
          }

          //when edit type menu click
          $('.edit-type-menu').on("click", function(event) {
            var food_menu_type_id = $(this).data('id');

            $.ajax({
                url: '/admin/food-menu-type/' + food_menu_type_id,
                menu: 'GET',
                datamenu: 'json',
                error: function(req, err){ console.log('error : ' + err) }
            })
            .done(function(response) {
                $("#form-edit-type").attr('action', '/admin/food-menu-type/' + food_menu_type_id);
                $("#menuTypeEdit").val(response['food_type']);
                $("#menuPriceEdit").val(response['price']);
                $("#menuIdEditType").val(response['food_menu']);
                $("#modal-default-6").modal('show');
            });
          });

           //when delete type menu click
          $('.delete-type-menu').on("click", function(event) {

            var food_menu_type_id = $(this).data('id');

            $("#form-delete-type").attr('action', '/admin/food-menu-type/' + food_menu_type_id);
            $("#modal-default-7").modal('show');
          });

          $("#modal-default-4").modal('show');
      });
    });
  })
</script>

{{-- add modal configuration --}}
<script>
  $(function(){
    $('.add-type-menu').on("click", function(event) {
      var food_menu_id = $(this).data('id');
      $("#menuIdType").val(food_menu_id);
      $("#modal-default-5").modal('show');
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