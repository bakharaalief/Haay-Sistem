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
                return redirect(route('food-size.index'))->with(['failed_store' => 'Kategori Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food size where delete == false and id same with parameter
                FoodSize::where('delete', false)->where('id', $id)->update([
                    'size' => $request['size'],
                    'visible' => $request['visible']
                ]);

                //redirect to index Food size
                return redirect(route('food-size.index'))->with(['success_update' => 'Kategori Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-size.index'))->with(['failed_update' => 'Kategori Gagal Diupdate']);
        }
    }

    public function updateVisible(Request $request, $id)
    {
        return dd($request);

        // try {
        //     //check data if exist in db
        //     $cekAda = FoodSize::where('delete', false)->where('size', $request['size'])->first();

        //     //if exist
        //     if (isset($cekAda)) {
        //         return redirect(route('food-size.index'))->with(['failed_store' => 'Kategori Gagal Diupdate karena sudah terdaftar']);
        //     }

        //     //else
        //     else {
        //         // update from table Food size where delete == false and id same with parameter
        //         FoodSize::where('delete', false)->where('id', $id)->update([
        //             'size' => $request['size'],
        //             'visible' => $request['visible']
        //         ]);

        //         //redirect to index Food size
        //         return redirect(route('food-size.index'))->with(['success_update' => 'Kategori Berhasil Diupdate']);
        //     }
        // } catch (Exception $e) {
        //     return redirect(route('food-size.index'))->with(['failed_update' => 'Kategori Gagal Diupdate']);
        // }
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
