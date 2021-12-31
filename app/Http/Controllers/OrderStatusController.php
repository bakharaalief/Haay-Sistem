<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Exception;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table order status where delete == false
        $dataOrderStatus = OrderStatus::where('delete', false)->get();

        //pass data to view
        return view('order-status.index')
            ->with(compact('dataOrderStatus'));
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
            $cekAda = OrderStatus::where('delete', false)->where('status', $request['status'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('order-status.index'))->with(['failed_store' => 'Status Pemesanan Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                OrderStatus::create([
                    'status' => $request['status'],
                ]);
                return redirect(route('order-status.index'))->with(['success_store' => 'Status Pemesanan Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('order-status.index'))->with(['failed_store' => 'Status Pemesanan Gagal Ditambah']);
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
        // get data from table order status where delete == false and id same with paramete
        $orderStatus = OrderStatus::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'status' => $orderStatus->status,
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
            $cekAda = OrderStatus::where('delete', false)->where('status', $request['status'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('order-status.index'))->with(['failed_store' => 'status pemesanan Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table order status where delete == false and id same with parameter
                OrderStatus::where('delete', false)->where('id', $id)->update([
                    'status' => $request['status']
                ]);

                //redirect to index order status
                return redirect(route('order-status.index'))->with(['success_update' => 'status pemesanan Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('order-status.index'))->with(['failed_update' => 'status pemesanan Gagal Diupdate']);
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
            OrderStatus::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('order-status.index'))->with(['success_delete' => 'status pemesanan Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('order-status.index'))->with(['failed_delete' => 'status pemesanan Gagal Dihapus']);
        }
    }

    public function updateVisible(Request $request)
    {
        try {
            //get data
            $orderStatus = $request->post();

            //check data if exist in db
            $cekAda = orderStatus::where('delete', false)->where('id', $orderStatus['order_status_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table order status where delete == false and id same with parameter
                orderStatus::where('delete', false)->where('id', $orderStatus['order_status_id'])->update([
                    'visible' => $orderStatus['order_visible']
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
