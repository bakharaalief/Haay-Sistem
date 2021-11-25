<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use Exception;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table food-type where delete == false
        $dataFoodType = FoodType::where('delete', false)->get();

        //pass data to view
        return view('food-type.index')->with(compact('dataFoodType'));
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
            $cekAda = FoodType::where('delete', false)->where('type', $request['type'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-type.index'))->with(['failed_store' => 'Tipe Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                FoodType::create([
                    'type' => $request['type'],
                ]);
                return redirect(route('food-type.index'))->with(['success_store' => 'Tipe Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-type.index'))->with(['failed_store' => 'Tipe Gagal Ditambah']);
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
        $foodType = FoodType::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'type' => $foodType->type,
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
            $cekAda = FoodType::where('delete', false)->where('type', $request['type'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-type.index'))->with(['failed_store' => 'Tipe Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food type where delete == false and id same with parameter
                FoodType::where('delete', false)->where('id', $id)->update([
                    'type' => $request['type']
                ]);

                //redirect to index Food type
                return redirect(route('food-type.index'))->with(['success_update' => 'Tipe Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-type.index'))->with(['failed_update' => 'Tipe Gagal Diupdate']);
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
            FoodType::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('food-type.index'))->with(['success_delete' => 'Tipe Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('food-type.index'))->with(['failed_delete' => 'Tipe Gagal Dihapus']);
        }
    }

    public function updateVisible(Request $request)
    {
        try {
            //get data
            $type = $request->post();

            //check data if exist in db
            $cekAda = FoodType::where('delete', false)->where('id', $type['type_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table Food type where delete == false and id same with parameter
                FoodType::where('delete', false)->where('id', $type['type_id'])->update([
                    'visible' => $type['type_visible']
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
