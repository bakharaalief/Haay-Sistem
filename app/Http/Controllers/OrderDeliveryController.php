<?php

namespace App\Http\Controllers;

use App\Models\OrderDelivery;
use Exception;
use Illuminate\Http\Request;

class OrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table order-delivery where delete == false
        $dataOrderDelivery = OrderDelivery::where('delete', false)->get();

        //pass data to view
        return view('order-delivery.index')
            ->with(compact('dataOrderDelivery'));
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
        try {
            //check data if exist in db
            $cekAda = OrderDelivery::where('delete', false)->where('delivery', $request['delivery'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('order-delivery.index'))->with(['failed_store' => 'kurir Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                OrderDelivery::create([
                    'delivery' => $request['delivery'],
                ]);
                return redirect(route('order-delivery.index'))->with(['success_store' => 'kurir Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('order-delivery.index'))->with(['failed_store' => 'kurir Gagal Ditambah']);
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
        // get data from table order delivery where delete == false and id same with paramete
        $orderDelivery = orderDelivery::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'delivery' => $orderDelivery->delivery,
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
            //check data if exist in db
            $cekAda = OrderDelivery::where('delete', false)->where('delivery', $request['delivery'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('order-delivery.index'))->with(['failed_store' => 'Kurir Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table order delivery where delete == false and id same with parameter
                OrderDelivery::where('delete', false)->where('id', $id)->update([
                    'delivery' => $request['delivery']
                ]);

                //redirect to index Food delivery
                return redirect(route('order-delivery.index'))->with(['success_update' => 'Kurir Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('order-delivery.index'))->with(['failed_update' => 'Kurir Gagal Diupdate']);
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
            //update data to delete false
            OrderDelivery::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('order-delivery.index'))->with(['success_delete' => 'Kurir Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('order-delivery.index'))->with(['failed_delete' => 'Kurir Gagal Dihapus']);
        }
    }

    public function updateVisible(Request $request)
    {
        try {
            //get data
            $delivery = $request->post();

            //check data if exist in db
            $cekAda = OrderDelivery::where('delete', false)->where('id', $delivery['delivery_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table order delivery where delete == false and id same with parameter
                OrderDelivery::where('delete', false)->where('id', $delivery['delivery_id'])->update([
                    'visible' => $delivery['delivery_visible']
                ]);

                return "berhasil update";
            }

            //else
            else return "gagal update";
        } catch (Exception $e) {
            return "gagal update";
        }
    }
}
