<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataOrder = Auth::user()->getOrder;
        return view('order-normal.index')->with(compact('dataOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $id = Auth::user()->id;

            $newOrder = Order::create([
                'user' => $id,
                'phone' => $request['order_phone'],
                'address' => $request['order_address'],
                'order_process_time' => $request['order_process_time'],
                'order_process_price_now' => $request['harga_pengerjaan'],
                'order_delivery' => $request['order_delivey'],
                'order_delivery_price_now' => $request['harga_pengiriman'],
                'order_status' => 1,
                'total_bayar' => $request['total_bayar'],
            ]);

            $cartData = Auth::user()->getCart->where('delete', false);

            foreach ($cartData as $data) {
                //insert cart item to order detail
                OrderDetail::create([
                    'order' => $newOrder->id,
                    'cart' => $data->id,
                    'price_now' => $data->getFoodMenuType->price
                ]);

                //update carti item to delete true
                Cart::where('id', $data->id)->update([
                    'delete' => true
                ]);
            }

            return redirect(route('normal.menu'))
                ->with(['success_store' => 'Berhasil Membuat Order']);
        } catch (Exception $e) {
            return redirect(route('normal.menu'))
                ->with(['failed_store' => 'Gagal Membuat Order']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //check data if exist in db
            $cekAda = Order::where('delete', false)->where('id', $id)->first();

            if ($cekAda) {
                $extension = $request['bukti_photo']->extension();

                //check photo file
                if ($extension != 'png' &&  $extension != 'jpeg' && $extension != 'jpg') {
                    return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Ditambah Karena File Photo Tidak Sesuai']);
                }

                //move new photo
                $imageName = time() . '.' . $extension;
                $request['bukti_photo']->move(public_path('images/foto_transfer/'), $imageName);

                //update from table Food Category where delete == false and id same with parameter
                Order::where('delete', false)->where('id', $id)->update([
                    'bukti_transfer' => $imageName,
                    'order_status' => 2,
                ]);
            }

            return redirect(route('order.index'))->with(['success_update' => 'Pembayaran Berhasil Dimasukkan']);
        } catch (Exception $e) {
            return redirect(route('order.index'))->with(['failed_update' => 'Pembayaran gagal Dimasukkan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Order::where('delete', false)->where('id', $id)->update([
                'order_status' => 6
            ]);

            return redirect(route('order.index'))->with(['success_update' => 'Order Berhasil Dibatalkan']);
        } catch (Exception $e) {
            return redirect(route('order.index'))->with(['failed_update' => 'Order Gagal Dibatalkan']);
        }
    }
}
