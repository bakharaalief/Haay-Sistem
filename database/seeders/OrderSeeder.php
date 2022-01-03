<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            //create admin
            Order::create([
                'user' => 2,
                'phone' => 1,
                'address' => 1,
                'order_process_time' => 2,
                'order_process_price_now' => 50000,
                'order_delivery' => 1,
                'order_delivery_price_now' => 50000,
                'bukti_transfer' => null,
                'order_status' => 5,
                'total_price' => 10000
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            //create admin
            Order::create([
                'user' => 2,
                'phone' => 1,
                'address' => 1,
                'order_process_time' => 2,
                'order_process_price_now' => 50000,
                'order_delivery' => 1,
                'order_delivery_price_now' => 50000,
                'bukti_transfer' => null,
                'order_status' => 6,
                'total_price' => 10000
            ]);
        }
    }
}
