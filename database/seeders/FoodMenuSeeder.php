<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_menus')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $foodMenu = [
            [
                'id' => 1,
                'name' => 'Kue Pukis',
                'description' => 'Kue Pukis Terenak di Jakarta',
                'food_category' => 1,
                'food_size' => 1,
                'visible' => false,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'name' => 'Snack Biskuit',
                'description' => 'Snack Biskuit Terenak di Jakarta',
                'food_category' => 2,
                'food_size' => 1,
                'visible' => false,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('food_menus')->insert($foodMenu);
    }
}
