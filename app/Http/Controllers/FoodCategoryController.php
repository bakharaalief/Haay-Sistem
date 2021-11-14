<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Exception;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table food-category where delete == false
        $dataFoodCategory = FoodCategory::where('delete', false)->get();

        //pass data to view
        return view('food-category.index')->with(compact('dataFoodCategory'));
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
            $cekAda = FoodCategory::where('delete', false)->where('category', $request['category'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-category.index'))->with(['failed_store' => 'Kategori Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                FoodCategory::create([
                    'category' => $request['category'],
                ]);
                return redirect(route('food-category.index'))->with(['success_store' => 'Kategori Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-category.index'))->with(['failed_store' => 'Kategori Gagal Ditambah']);
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
        // get data from table Food Category where delete == false and id same with paramete
        $foodCategory = FoodCategory::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'category' => $foodCategory->category,
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
            $cekAda = FoodCategory::where('delete', false)->where('category', $request['category'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-category.index'))->with(['failed_store' => 'Kategori Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table Food Category where delete == false and id same with parameter
                FoodCategory::where('delete', false)->where('id', $id)->update([
                    'category' => $request['category']
                ]);

                //redirect to index Food Category
                return redirect(route('food-category.index'))->with(['success_update' => 'Kategori Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('food-category.index'))->with(['failed_update' => 'Kategori Gagal Diupdate']);
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
            FoodCategory::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('food-category.index'))->with(['success_delete' => 'Kategori Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('food-category.index'))->with(['failed_delete' => 'Kategori Gagal Dihapus']);
        }
    }
}
