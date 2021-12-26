<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            FoodSizeSeeder::class,
            FoodCategorySeeder::class,
            FoodTypeSeeder::class,
            OrderStatusSeeder::class
        ]);
    }
}
