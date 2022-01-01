<?php

namespace Database\Seeders;

use App\Models\FoodMenu;
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
        //all about user
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            PhoneSeeder::class,
            AddressSeeder::class,
        ]);

        //all about menu
        $this->call([
            FoodSizeSeeder::class,
            FoodCategorySeeder::class,
            FoodTypeSeeder::class,
            FoodMenuSeeder::class
        ]);

        //all about order
        $this->call([
            OrderDeliverySeeder::class,
            OrderStatusSeeder::class,
            OrderProcessTime::class,
            OrderSeeder::class
        ]);
    }
}
