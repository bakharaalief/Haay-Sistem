<?php

namespace App\Http\Controllers;

use App\Models\FoodTopping;
use Exception;
use Illuminate\Http\Request;

class FoodToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table food-Topping where delete == false
        $dataFoodTopping = FoodTopping::where('delete', false)->get();

        //pass data to view
        return view('food-topping.index')->with(compact('dataFoodTopping'));
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
            $cekAda = FoodTopping::where('delete', false)->where('topping', $request['topping'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-topping.index'))->with(['failed_store' => 'Tooping Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                //proses merubah rupiah ke int
                $harga_str = preg_replace("/[^0-9]/", "", $request['price']);
                $harga_int = (int) $harga_str;

                FoodTopping::create([
                    'topping' => $request['topping'],
                    'price' => $harga_int
                ]);
                return redirect(route('food-topping.index'))->with(['success_store' => 'Tooping Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-topping.index'))->with(['failed_store' => 'Tooping Gagal Ditambah']);
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
        // get data from table Food topping where delete == false and id same with paramete
        $foodTopping = FoodTopping::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'topping' => $foodTopping->topping,
            'price' => $foodTopping->price,
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
            $cekAda = FoodTopping::where('delete', false)->where('topping', $request['topping'])->first();

            //proses merubah rupiah ke int
            $harga_str = preg_replace("/[^0-9]/", "", $request['price']);
            $harga_int = (int) $harga_str;

            //if exist
            if ($cekAda->topping ==  $request['topping'] && $cekAda->price == $harga_int) {
                return redirect(route('food-topping.index'))->with(['failed_store' => 'Topping Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food topping where delete == false and id same with parameter
                FoodTopping::where('delete', false)->where('id', $id)->update([
                    'topping' => $request['topping'],
                    'price' => $harga_int,
                ]);

                //redirect to index Food topping
                return redirect(route('food-topping.index'))->with(['success_update' => 'Topping Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-topping.index'))->with(['failed_update' => 'Topping Gagal Diupdate']);
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
            FoodTopping::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('food-topping.index'))->with(['success_delete' => 'Topping Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('food-topping.index'))->with(['failed_delete' => 'Topping Gagal Dihapus']);
        }
    }
}
