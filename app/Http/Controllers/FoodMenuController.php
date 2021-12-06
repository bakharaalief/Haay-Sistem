<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\Foodmenu;
use App\Models\FoodSize;
use App\Models\FoodType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

        //get data from table food-size
        $dataFoodType = FoodType::where('delete', false)
            ->get();

        //pass data to view
        return view('food-menu.index')->with(
            compact('dataFoodMenu', 'dataFoodCategory', 'dataFoodSize', 'dataFoodType')
        );
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
        try {
            //check data if exist in db
            $cekAda = FoodMenu::where('delete', false)->where('name', $request['menu_name'])->first();

            //if exist
            if (
                isset($cekAda)
                && $cekAda->description == $request['menu_description']
                && $cekAda->food_category == $request['menu_category']
                && $cekAda->food_size == $request['menu_size']
                && $request['menu_photo'] == null
            ) {
                return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                //update without photo
                if ($request['menu_photo'] == null) {
                    //update from table Food Category where delete == false and id same with parameter
                    FoodMenu::where('delete', false)->where('id', $id)->update([
                        'name' => $request['menu_name'],
                        'description' => $request['menu_description'],
                        'food_category' => $request['menu_category'],
                        'food_size' => $request['menu_size'],
                    ]);

                    //redirect to index Food Category
                    return redirect(route('food-menu.index'))->with(['success_update' => 'Menu Berhasil Diupdate']);
                }

                //update with photo
                else {
                    $extension = $request['menu_photo']->extension();

                    //check photo file
                    if ($extension != 'png' &&  $extension != 'jpeg' && $extension != 'jpg') {
                        return redirect(route('food-menu.index'))->with(['failed_store' => 'Menu Gagal Ditambah Karena File Photo Tidak Sesuai']);
                    }

                    //delete old photo
                    File::delete(public_path("images/foto_menu/" . $cekAda->link_image));

                    //move new photo
                    $imageName = time() . '.' . $extension;
                    $request['menu_photo']->move(public_path('images/foto_menu/'), $imageName);

                    //update from table Food Category where delete == false and id same with parameter
                    FoodMenu::where('delete', false)->where('id', $id)->update([
                        'name' => $request['menu_name'],
                        'description' => $request['menu_description'],
                        'food_category' => $request['menu_category'],
                        'food_size' => $request['menu_size'],
                        'link_image' => $imageName
                    ]);

                    //redirect to index Food Category
                    return redirect(route('food-menu.index'))->with(['success_update' => 'Menu Berhasil Diupdate']);
                }
            }
        } catch (Exception $e) {
            return redirect(route('food-menu.index'))->with(['failed_update' => 'Menu Gagal Diupdate']);
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
        //
    }

    public function updateVisible(Request $request)
    {
        $request->post();

        try {
            //get data
            $menu = $request->post();

            //check data if exist in db
            $cekAda = FoodMenu::where('delete', false)->where('id', $menu['menu_id'])->first();

            //if exist
            if (isset($cekAda)) {
                // update from table Food menu where delete == false and id same with parameter
                FoodMenu::where('delete', false)->where('id', $menu['menu_id'])->update([
                    'visible' => $menu['menu_visible']
                ]);

                return "berhasil update";
            }

            //else
            else return "gagal update";
        } catch (Exception $e) {
            return "gagal update";
        }
    }

    public function allType($id)
    {
        // get data from table Food menu where delete == false and id same with paramete
        $foodMenu = FoodMenu::where('delete', false)->findOrFail($id);

        // return in json format
        return response()->json([
            'name' => $foodMenu->name,
            'description' => $foodMenu->description,
            'food_category' => $foodMenu->food_category,
            'food_size' => $foodMenu->food_size,
            'all_type' =>  $foodMenu->getFoodType
        ]);
    }
}
