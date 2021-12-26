@extends('layouts.normal.app')

@section('css')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css ') }}">
@endSection

@section('content')
<div class="menu-detail-2 container pt-4">
    <div class="row">
        <div class="side-1 mr-4">
            <img 
                class="menu-detail-2-cover" 
                src="https://upload.wikimedia.org/wikipedia/commons/0/04/Pound_layer_cake.jpg" alt="">

            <h4 class="menu-detail-2-title">{{ $foodMenu->name }}</h4>
        </div>
        <div class="side-2 col-xl">
            <p class="menu-detail-2-desc">
                {{ $foodMenu->description }}
            </p>

            <div class="menu-detail-2-type">
                @if (count($foodMenu->getFoodType) > 0)
                @foreach ($foodMenu->getFoodType as $foodType)
                <div 
                    class="type"
                    data-type="{{ $foodType->pivot->id }}"
                    data-harga="{{ $foodType->pivot->price }}">
                    {{ $foodType->type }}
                </div>          
                @endforeach         
                @else
                <div class="type-none">
                    None
                </div>   
                @endif
            </div>

            <div class="menu-amount">
                <div class="minus-amount-button">
                    <p>-</p>
                </div>
                <p class="menu-amount-detail">1</p>
                <div class="plus-amount-button">
                    <p>+</p>
                </div>
            </div>

            <h4 class="menu-detail-2-price">Rp. 0</h4>

            
            <div 
                class="add-keranjang"
                @guest data-login="0" @else data-login="1" @endguest>
                <p>Masukkan Keranjang</p>
            </div>
        </div>
    </div>

    {{-- tambah modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Masukkan Ke Keranjang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="{{ route('cart.store') }}">
              @csrf

              <div class="modal-body">

                <div class="form-group">
                    <label for="menuNotes">Catatan</label>
                    <textarea class="form-control" id="menuNotes" rows="3" name="menu_notes" placeholder="Masukkan Notes" required></textarea>
                </div>

                <div class="form-group">
                    <label for="menuPhoto">Foto Referensi ( JIka Ada )</label>
                    <input type="file" class="form-control-file" id="menuPhoto" name="menu_photo">
                </div>

                <input type="number" class="form-control" id="menuType" name="menu_type" required hidden>

                <input type="number" class="form-control" id="menuAmount" name="menu_amount" required hidden>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

            </form>
          </div>
        </div>
    </div>
</div>



@endsection

@section('js')
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil tambah foodtype--}}
@if ($message = Session::get('success_store'))
  <script>
    toastr.success('{{ $message }}');
  </script>
@endif

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

        var idMenuType = 0
        var jumlahBarang = 1
        var hargaBarang = 0

        //jumlah barang
        $('.menu-amount-detail').text(jumlahBarang)
        var hasil = formatRupiah((hargaBarang*jumlahBarang).toString(), 'Rp. ')
        $('.menu-detail-2-price').text(hasil)

        //minus button click
        $('.minus-amount-button').click(function(){
            if(jumlahBarang > 0) jumlahBarang--
            else jumlahBarang = 0

            var hasil = formatRupiah((hargaBarang*jumlahBarang).toString(), 'Rp. ')
            $('.menu-amount-detail').text(jumlahBarang)
            $('.menu-detail-2-price').text(hasil)
        })

        //plus button click
        $('.plus-amount-button').click(function(){
            jumlahBarang++
            var hasil = formatRupiah((hargaBarang*jumlahBarang).toString(), 'Rp. ')
            $('.menu-amount-detail').text(jumlahBarang)
            $('.menu-detail-2-price').text(hasil)
        })

        //type layer
        $('.type').click(function(){
            // remove the active class from all elements with active class
            $('.active').removeClass('active')
            // add active class to clicked element
            $(this).addClass('active');

            const harga = $(this).data('harga');
            const id = $(this).data('type');

            idMenuType = id
            hargaBarang = harga
            jumlahBarang = 1

            $('.menu-amount-detail').text(jumlahBarang)
            var hasil = formatRupiah((hargaBarang*jumlahBarang).toString(), 'Rp. ')
            $('.menu-detail-2-price').text(hasil)
        })

        //keranjang add
        $('.add-keranjang').click(function(){
            if(idMenuType == 0){
                toastr.error('Kamu Belum Memilih Barang');
            }
            else{
                const statusLogin = $(this).data('login');
                if(statusLogin == 0) {
                    window.location.href = "{{ route('login') }}";
                }
                else {
                    $("#modal-default").modal('show');
                    $("#menuType").val(idMenuType);
                    $("#menuAmount").val(jumlahBarang);
                }
            }
        })
    })
</script>
@endSection