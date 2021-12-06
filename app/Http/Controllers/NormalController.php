<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\FoodMenu;
use App\Models\FoodSize;
use App\Models\FoodType;
use Illuminate\Http\Request;

class NormalController extends Controller
{
    function homeIndex()
    {
        $dataFoodCategory = FoodCategory::where('delete', false)
            ->where('visible', true)
            ->get();

        return view('home')->with(compact('dataFoodCategory'));
    }

    function menuIndex()
    {
        $dataFoodCategory = FoodCategory::where('delete', false)
            ->where('visible', true)
            ->get();

        $dataFoodSize = FoodSize::where('delete', false)
            ->where('visible', true)
            ->get();

        $dataFoodType = FoodType::where('delete', false)
            ->where('visible', true)
            ->get();

        $dataFoodMenu = FoodMenu::where('delete', false)
            ->where('visible', true)
            ->get();

        return view('food-menu-normal.index')
            ->with(compact('dataFoodCategory', 'dataFoodSize', 'dataFoodType', 'dataFoodMenu'));
    }

    function menuDetail($id)
    {
        $foodMenu = FoodMenu::where('delete', false)
            ->where('visible', true)
            ->findOrFail($id);

        return view('food-menu-detail.index')->with(compact('foodMenu'));

        // return response()->json([
        //     $foodMenu->getFoodType
        // ]);
    }
}
