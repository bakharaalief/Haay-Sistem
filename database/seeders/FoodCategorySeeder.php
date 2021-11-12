<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_categories')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $categories = [
            [
                'id' => 1,
                'category' => 'Kue',
                'visible' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'category' => 'Snack',
                'visible' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('food_categories')->insert($categories);
    }
}
