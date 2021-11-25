<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\Foodmenu;
use App\Models\FoodSize;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Mime\MimeTypes;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table food-menu where delete == false
        $dataFoodMenu = FoodMenu::where('delete', false)->get();

        //get data from table food-menu
        $dataFoodCategory = FoodCategory::where('delete', false)
            ->get();

        //get data from table food-size
        $dataFoodSize = FoodSize::where('delete', false)
            ->get();

        //pass data to view
        return view('food-menu.index')->with(compact('dataFoodMenu', 'dataFoodCategory', 'dataFoodSize'));
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
            $cekAda = FoodMenu::where('delete', false)->where('name', $request['menu_name'])->first();
            $extension = $request['menu_photo']->extension();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Ditambah karena sudah terdaftar']);
            }

            //photo file
            else if ($extension != 'png' &&  $extension != 'jpeg' && $extension != 'jpg') {
                return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Ditambah Karena File Photo Tidak Sesuai']);
            }

            //else
            else {
                $imageName = time() . '.' . $extension;
                $request['menu_photo']->move(public_path('images/foto_menu/'), $imageName);

                FoodMenu::create([
                    'name' => $request['menu_name'],
                    'description' => $request['menu_description'],
                    'food_category' => $request['menu_category'],
                    'food_size' => $request['menu_size'],
                    'link_image' => $imageName
                ]);

                return redirect(route('food-menu.index'))->with(['success_store' => 'Menu Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Ditambah']);
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
        // get data from table Food menu where delete == false and id same with paramete
        $foodMenu = FoodMenu::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'name' => $foodMenu->name,
            'description' => $foodMenu->description,
            'food_category' => $foodMenu->food_category,
            'food_size' => $foodMenu->food_size,
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
        //
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
