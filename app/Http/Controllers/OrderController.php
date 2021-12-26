<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
