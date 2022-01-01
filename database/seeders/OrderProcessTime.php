<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProcessTime extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_process_times')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $process_time = [
            [
                'id' => 1,
                'order_process_time' => 'Lebih dari 3 Hari',
                'price' => 0,
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'order_process_time' => 'Kurang dari 3 Hari',
                'price' => 50000,
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('order_process_times')->insert($process_time);
    }
}
