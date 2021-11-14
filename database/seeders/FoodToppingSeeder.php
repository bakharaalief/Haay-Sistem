<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_toppings')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $toppings = [
            [
                'id' => 1,
                'topping' => 'Mesis',
                'price' => 1000,
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'topping' => 'Tulisan',
                'price' => 1000,
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('food_toppings')->insert($toppings);
    }
}
