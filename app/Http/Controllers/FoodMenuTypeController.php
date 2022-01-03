<?php

namespace App\Http\Controllers;

use App\Models\FoodMenuType;
use Exception;
use Illuminate\Http\Request;

class FoodMenuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table Food menu where delete == false and id same with paramete
        // $foodMenu = FoodMenuType::where('delete', false)->findOrFail($id);

        // // //return in json format
        // return response()->json([
        //     'name' => $foodMenu->name,
        //     'description' => $foodMenu->description,
        //     'food_category' => $foodMenu->food_category,
        //     'food_size' => $foodMenu->food_size,
        // ]);
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
            $cekAda = FoodMenuType::where('delete', false)
                ->where('food_menu', $request['menu_id'])
                ->where('food_type', $request['menu_type'])
                ->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-menu.index'))->with(['failed_store' => 'Tipe Menu Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                $harga_str = preg_replace("/[^0-9]/", "", $request['menu_price']);
                $harga_int = (int) $harga_str;

                FoodMenuType::create([
                    'food_type' => $request['menu_type'],
                    'price' => $harga_int,
                    'food_menu' => $request['menu_id']
                ]);
                return redirect(route('food-menu.index'))->with(['success_store' => 'Tipe Menu Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-menu.index'))->with(['failed_store' => 'Tipe Menu Gagal Ditambah']);
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
        // get data from table Food type where delete == false and id same with paramete
        $foodMenuType = FoodMenuType::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'food_menu' => $foodMenuType->food_menu,
            'food_type' => $foodMenuType->food_type,
            'price' => $foodMenuType->price,
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
            $cekAda = FoodMenuType::where('delete', false)
                ->where('food_menu', $request['menu_id'])
                ->where('food_type', $request['menu_type'])->first();

            //if exist
            if (
                isset($cekAda) &&
                $cekAda->food_type == $request['menu_type'] &&
                $cekAda->price == $request['menu_price']
            ) {
                return redirect(route('food-menu.index'))->with(['failed_store' => 'Tipe Menu Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food menu type where delete == false and id same with parameter
                FoodMenuType::where('delete', false)->where('id', $id)->update([
                    'food_type' => $request['menu_type'],
                    'price' => $request['menu_price']
                ]);

                //redirect to index Food orderProcessTime
                return redirect(route('food-menu.index'))->with(['success_update' => 'Tipe Menu Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-menu.index'))->with(['failed_update' => 'Tipe Menu Gagal Diupdate']);
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
            FoodMenuType::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('food-menu.index'))->with(['success_delete' => 'Tipe Menu pemesanan Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('food-menu.index'))->with(['failed_delete' => 'Tipe Menu pemesanan Gagal Dihapus']);
        }
    }
}
