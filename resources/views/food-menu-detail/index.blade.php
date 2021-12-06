@extends('layouts.normal.app')

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
                    data-menuType="{{ $foodType->id }}"
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

            <div class="add-keranjang">
                <p>Masukkan Keranjang</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
            const id = $(this).data('menuType');

            idMenuType = id
            hargaBarang = harga
            jumlahBarang = 1

            $('.menu-amount-detail').text(jumlahBarang)
            var hasil = formatRupiah((hargaBarang*jumlahBarang).toString(), 'Rp. ')
            $('.menu-detail-2-price').text(hasil)
        })
    })
</script>
@endsection