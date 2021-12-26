@extends('layouts.normal.app')

@section('content')
<h1 class="text-center text-font font-weight-bold pt-4">Keranjang Menu</h1>

@php
//rupiah
function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    echo $hasil_rupiah;
}

$totalHarga = 0;
@endphp

<div class="keranjang container">
    @foreach ($cartData as $data)

    @php
    $totalHargaMenu = 0;
    $totalHargaMenu += $data->getFoodMenuType->price*$data->amount;

    $totalHarga += $totalHargaMenu;
    @endphp

    <div class="keranjang-item">
        <img class="keranjang-image" src="https://upload.wikimedia.org/wikipedia/commons/0/04/Pound_layer_cake.jpg" alt="">
        <div class="keranjang-detail">
            <h1 class="nama-menu">{{ $data->getFoodMenuType->getFoodMenu()->name }}</h1>
            <p class="ukuran-menu">Ukuran : Small</p>
            <p class="type-menu">Type : {{ $data->getFoodMenuType->getFoodType()->type }}</p>
            <p class="catatan-menu">Catatan : {{ $data->notes }}</p>
            <p class="jumlah-menu">Jumlah : {{ $data->amount }}</p>
            <h4 class="total-menu">{{ rupiah($totalHargaMenu) }}</h4>

            <form method="POST" action="{{ route('cart.destroy', ['cart' => $data->id ])}}">
                @csrf
                @method('Delete')

                <button type="submit" class="btn btn-danger mt-2">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

    @if (count($cartData) > 0)
    <div class="keranjang-informasi">
        <h4 class="total-harga">Total : {{ rupiah($totalHarga) }}</h4>
        <div class="beli-button" data-harga="{{ $totalHarga }}">
            <p>Beli</p>
        </div>
    </div>
    @endif

    {{-- modal tambah order --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Melakukan Pembelian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="{{ route('order.store') }}">
              @csrf

              <div class="modal-body">

                <div class="form-group">
                    <label for="orderProcessTime">Lama Pengerjaan</label>
                    <select class="form-control" id="orderProcessTime" name="order_process_time">
                        @foreach ($orderProcessTimeData as $orderProcessTime)
                        <option 
                            value="{{  $orderProcessTime->id }}" 
                            data-price="{{ $orderProcessTime->price }}" 
                            data-name="{{ $orderProcessTime->order_process_time }}">{{ $orderProcessTime->order_process_time }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="orderPhone">Nomor Pengiriman</label>
                    <select class="form-control" id="orderPhone" name="order_phone">
                        @foreach ($phoneData as $phone)
                        <option value="{{ $phone->id }}">{{ $phone->phone }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="orderAddress">Alamat Pengiriman</label>
                    <select class="form-control" id="orderPhone" name="order_address">
                        @foreach ($addressData as $address)
                        <option value="{{ $address->id }}">{{ $address->address }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="orderDelivery">Kurir</label>
                    <select class="form-control" id="orderDelivery" name="order_delivey">
                        @foreach ($deliveryData as $delivery)
                        <option 
                            value="{{ $delivery->id }}"
                            data-price="50000"
                            data-name="{{ $delivery->delivery }}">{{ $delivery->delivery}}</option>
                        @endforeach
                    </select>
                </div>

                <input id="hargaPengerjaan" type="number" name="harga_pengerjaan" hidden>

                <input id="hargaPengiriman" type="number" name="harga_pengiriman" hidden>


                <div class="pemisah py-2"></div>

                <h4 class="text-title">Total Harga Menu</h4>
                <p class="text-harga total-harga-menu">{{  rupiah($totalHarga) }}</p>

                <h4 class="text-title text-pengerjaan">Pengerjaan kurang 3 Hari</h4>
                <p class="text-harga total-harga-pengerjaan">Rp. 3.000</p>

                <h4 class="text-title text-pengiriman">Gojek</h4>
                <p class="text-harga total-harga-pengiriman">Rp. 50.000</p>

                <h4 class="text-title text-success">Total Seluruhnya</h4>
                <p class="text-harga total-harga-seluruhnya">Rp. 180.000</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Beli</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    $(function(){
        $('.beli-button').click(function(){
            $("#modal-default").modal('show');
            setDeliveryData()
        })

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

        function setDeliveryData(){
            //total harga menu
            var totalHarga = $('.beli-button').data('harga');

            //order process time
            var hargaProcess = $('#orderProcessTime').find(':selected').data('price');
            var namaProcess = $('#orderProcessTime').find(':selected').data('name');

            $('.text-pengerjaan').text(namaProcess);
            $('#hargaPengerjaan').val(hargaProcess);
            $('.total-harga-pengerjaan').text(formatRupiah(hargaProcess.toString(), 'Rp. '));

            //kurir
            var hargaKurir = $('#orderDelivery').find(':selected').data('price');
            var namaKurir = $('#orderDelivery').find(':selected').data('name');

            $('.text-pengiriman').text(namaKurir);
            $('#hargaPengiriman').val(hargaKurir);
            $('.total-harga-pengiriman').text(formatRupiah(hargaKurir.toString(), 'Rp. '));

            var totalHargaSeluruhnya = totalHarga + hargaProcess + hargaKurir;

            $('.total-harga-seluruhnya').text(formatRupiah(totalHargaSeluruhnya.toString(), 'Rp. '));
        }

        $('#orderProcessTime').change(function() {
            setDeliveryData();
        });

        $('#orderDelivery').change(function() {
            setDeliveryData();
        });
    });
</script>
@endSection