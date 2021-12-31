<?php

namespace App\Http\Controllers;

use App\Models\OrderProcessTime;
use Exception;
use Illuminate\Http\Request;

class OrderProcessTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table order-process-time where delete == false
        $dataOrderProcessTime = OrderProcessTime::where('delete', false)->get();

        //pass data to view
        return view('order-process-time.index')
            ->with(compact('dataOrderProcessTime'));
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
            $cekAda = OrderProcessTime::where('delete', false)
                ->where('order_process_time', $request['orderProcessTime'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('order-process-time.index'))->with(['failed_store' => 'Lama Process Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                OrderProcessTime::create([
                    'order_process_time' => $request['orderProcessTime'],
                    'price' => $request['orderProcessPrice']
                ]);
                return redirect(route('order-process-time.index'))->with(['success_store' => 'Lama Process Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('order-process-time.index'))->with(['failed_store' => 'Lama Process Gagal Ditambah']);
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
        // get data from table Food orderProcessTime where delete == false and id same with paramete
        $orderProcessTime = OrderProcessTime::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'order_process_time' => $orderProcessTime->order_process_time,
            'price' => $orderProcessTime->price,
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
            $cekAda = OrderProcessTime::where('delete', false)
                ->where('order_process_time', $request['orderProcessTime'])->first();

            //if exist
            if (
                isset($cekAda) &&
                $cekAda->order_process_time == $request['orderProcessTime'] &&
                $cekAda->price == $request['orderProcessPrice']
            ) {
                return redirect(route('order-process-time.index'))->with(['failed_store' => 'Lama Process Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food orderProcessTime where delete == false and id same with parameter
                OrderProcessTime::where('delete', false)->where('id', $id)->update([
                    'order_process_time' => $request['orderProcessTime'],
                    'price' => $request['orderProcessPrice']
                ]);

                //redirect to index Food orderProcessTime
                return redirect(route('order-process-time.index'))->with(['success_update' => 'Lama Process Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('order-process-time.index'))->with(['failed_update' => 'Lama Process Gagal Diupdate']);
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
            OrderProcessTime::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('order-process-time.index'))->with(['success_delete' => 'Kategori Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('order-process-time.index'))->with(['failed_delete' => 'Kategori Gagal Dihapus']);
        }
    }


    public function updateVisible(Request $request)
    {
        try {
            //get data
            $orderProcessTime = $request->post();

            //check data if exist in db
            $cekAda = OrderProcessTime::where('delete', false)->where('id', $orderProcessTime['process_time_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table order process time where delete == false and id same with parameter
                OrderProcessTime::where('delete', false)->where('id', $orderProcessTime['process_time_id'])->update([
                    'visible' => $orderProcessTime['process_time_visible']
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
