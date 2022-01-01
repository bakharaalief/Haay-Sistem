@extends('layouts.normal.app')


@section('css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css ') }}">
@endsection

@section('content')
<h1 class="text-center text-font font-weight-bold pt-4">Order</h1>

<div class="order container py-5">

    @foreach ($dataOrder as $order)
    <div class="order-item">
        <div class="order-info">
            <h4 class="id-order">ID : {{ $order->id }}</h4>
            <p class="tanggal-order">Tanggal : {{ $order->created_at }}</p>
            <p class="phone-order">No-Telp : {{ $order->getPhone->phone }}</p>
            <p class="alamat-order">Alamat : {{ $order->getAddress->address }}</p>
            <p class="delivery-order">Kurir : {{ $order->getKurir->delivery }}</p>
            <p class="delivery-order">Total Bayar : {{ $order->total_bayar }}</p>
            <p class="status-order">Status : {{ $order->getStatus->status }}</p>
        </div>
        <div class="order-action">
            @if ($order->order_status == 1)
            <button class="btn btn-success button-bayar" data-id="{{ $order->id }}">Bayar</button>
            <button class="btn btn-primary button-detail">Detail</button>

            <form method="POST" action="{{ route('order.destroy', ['order' => $order->id ])}}">
              @csrf
              @method('Delete')

              <button class="btn btn-danger button-delete">Batalkan</button>
            </form>
            
            @elseif($order->order_status == 2)
            <button href="#" class="btn btn-primary button-detail">Detail</button>
            <form method="POST" action="{{ route('order.destroy', ['order' => $order->id ])}}">
              @csrf
              @method('Delete')

              <button class="btn btn-danger button-delete">Batalkan</button>
            </form>
            @else
            <button href="#" class="btn btn-primary button-detail">Detail</button>
            @endif
        </div>
    </div>
    @endforeach

    {{-- bayar modal --}}
    <div class="modal fade" id="modal-default-1">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Bayar Menu</h4>
              <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" id="form-bayar" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="modal-body">

                <h4 class="font-weight-bold">Lakukan Pembayaran Pada Bank</h4>
                <p style="margin-bottom: 0px">BRI : 1910130012</p>
                <p style="margin-bottom: 0px">BCA : 1910130012</p>
                <p style="margin-bottom: 20px">BNI : 1910130012</p>

                {{-- form photo bukti --}}
                <div class="form-group">
                    <label for="buktiPhoto">Masukkan Bukti Pembayaran</label>
                    <input type="file" class="form-control-file" id="buktiPhoto" name="bukti_photo" required>
                </div>

              </div>
              <div class="modal-footer justify-content-between">
                <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button menu="submit" class="btn btn-primary">Masukkan</button>
              </div>

            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
{{-- brazil modal configuration --}}
<script>
  $(function(){
    $('.button-bayar').on("click", function(event) {
      var order_id = $(this).data('id');
      $("#form-bayar").attr('action', '/order/' + order_id);

      $("#modal-default-1").modal('show');
    });
  })  
</script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

{{-- berhasil update order--}}
@if ($message = Session::get('success_update'))
<script>
  toastr.success('{{ $message }}');
</script>
@endif

{{-- gagal update order --}}
@if ($message = Session::get('failed_update'))
<script>
  toastr.error('{{ $message }}');
</script>
@endif

@endsection