@extends('layouts.normal.app')

@section('content')
<h1 class="text-center text-font font-weight-bold pt-4">Order</h1>

<div class="order container">

    @foreach ($dataOrder as $order)
    <div class="order-item">
        <div class="order-info">
            <h4 class="id-order">ID : {{ $order->id }}</h4>
            <p class="tanggal-order">Tanggal : {{ $order->created_at }}</p>
            <p class="phone-order">No-Telp : {{ $order->getPhone->phone }}</p>
            <p class="alamat-order">Alamat : {{ $order->getAddress->address }}</p>
            <p class="delivery-order">Kurir : {{ $order->getKurir->delivery }}</p>
            <p class="status-order">Status : {{ $order->getStatus->status }}</p>
        </div>
        <div class="order-action">
            <a href="" class="btn btn-primary button-detail">Detail</a>
            <a href="" class="btn btn-danger button-delete">Delete</a>
        </div>
    </div>
    @endforeach
</div>
@endsection