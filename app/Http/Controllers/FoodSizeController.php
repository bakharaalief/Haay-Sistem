<?php

namespace App\Http\Controllers;

use App\Models\FoodSize;
use Exception;
use Illuminate\Http\Request;

class FoodSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table food-size where delete == false
        $dataFoodSize = FoodSize::where('delete', false)->get();

        //pass data to view
        return view('food-size.index')->with(compact('dataFoodSize'));
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
            $cekAda = FoodSize::where('delete', false)->where('size', $request['size'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-size.index'))->with(['failed_store' => 'size Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                FoodSize::create([
                    'size' => $request['size'],
                ]);
                return redirect(route('food-size.index'))->with(['success_store' => 'size Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-size.index'))->with(['failed_store' => 'size Gagal Ditambah']);
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
        // get data from table Food size where delete == false and id same with paramete
        $foodSize = FoodSize::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'size' => $foodSize->size,
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
            $cekAda = FoodSize::where('delete', false)->where('size', $request['size'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-size.index'))->with(['failed_store' => 'size Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food size where delete == false and id same with parameter
                FoodSize::where('delete', false)->where('id', $id)->update([
                    'size' => $request['size']
                ]);

                //redirect to index Food size
                return redirect(route('food-size.index'))->with(['success_update' => 'size Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-size.index'))->with(['failed_update' => 'size Gagal Diupdate']);
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
            FoodSize::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('food-size.index'))->with(['success_delete' => 'size Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('food-size.index'))->with(['failed_delete' => 'size Gagal Dihapus']);
        }
    }

    public function updateVisible(Request $request)
    {
        try {
            //get data
            $size = $request->post();

            //check data if exist in db
            $cekAda = FoodSize::where('delete', false)->where('id', $size['size_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table Food size where delete == false and id same with parameter
                FoodSize::where('delete', false)->where('id', $size['size_id'])->update([
                    'visible' => $size['size_visible']
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
