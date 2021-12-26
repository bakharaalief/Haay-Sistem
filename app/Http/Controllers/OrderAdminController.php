<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Exception;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataOrder = Order::all();
        $dataStatus = OrderStatus::all();

        return view('order.index')->with(compact('dataOrder', 'dataStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get data from table order where delete == false and id same with paramete
        $order = Order::where('delete', false)->findOrFail($id);

        // return in json format
        return response()->json([
            'id' => $order->id,
            'order_status' => $order->order_status,
        ]);
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
            // update from table order where delete == false and id same with parameter
            Order::where('delete', false)->where('id', $id)->update([
                'order_status' => $request['order_status']
            ]);

            //redirect to index level
            return redirect(route('admin.order.index'))->with(['success_update' => 'Order Berhasil Diupdate']);
        } catch (Exception $e) {
            return redirect(route('admin.order.index'))->with(['failed_update' => 'Order Gagal Diupdate']);
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
        //
    }

    public function orderDetail($id)
    {
        // get data from table order where delete == false and id same with paramete
        $order = Order::where('delete', false)->findOrFail($id);

        //array for sub data
        $array = array();

        foreach ($order->getDetailOrder as $data) {
            $array1 = array(
                'food_menu_name' => $data->getCart->getFoodMenuType->getFoodMenu()->name,
                'food_menu_category' => $data->getCart->getFoodMenuType->getFoodMenu()->getCategory->category,
                'food_menu_type' => $data->getCart->getFoodMenuType->getFoodType()->type,
                'amount' => $data->getCart->amount,
                'price_now' => $data->price_now,
            );

            array_push($array, $array1);
        }

        // return in json format
        return response()->json([
            'id' => $order->id,
            'detail_order' => $array,
        ]);
    }
}
