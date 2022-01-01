<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_deliveries')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $delivery = [
            [
                'id' => 1,
                'delivery' => 'Gojek',
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'delivery' => 'Grab',
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('order_deliveries')->insert($delivery);
    }
}
