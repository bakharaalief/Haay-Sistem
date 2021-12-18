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
    $totalHarga += $data->getFoodMenuType->price;
    @endphp

    <div class="keranjang-item">
        <img class="keranjang-image" src="https://upload.wikimedia.org/wikipedia/commons/0/04/Pound_layer_cake.jpg" alt="">
        <div class="keranjang-detail">
            <h1 class="nama-menu">{{ $data->getFoodMenuType->getFoodMenu()->name }}</h1>
            <p class="ukuran-menu">Ukuran : Small</p>
            <p class="type-menu">Type : {{ $data->getFoodMenuType->getFoodType()->type }}</p>
            <p class="catatan-menu">Catatan : {{ $data->notes }}</p>
            <p class="jumlah-menu">Jumlah : {{ $data->amount }}</p>
            <h4 class="total-menu">{{ rupiah($data->getFoodMenuType->price) }}</h4>

            <form method="POST" action="{{ route('cart.destroy', ['cart' => $data->id ])}}">
                @csrf
                @method('Delete')

                <button type="submit" class="btn btn-danger mt-2">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

    <div class="keranjang-informasi">
        <h4 class="total-harga">Total : {{ rupiah($totalHarga) }}</h4>
        <div class="beli-button">
            <p>Beli</p>
        </div>
    </div>
</div>
@endsection