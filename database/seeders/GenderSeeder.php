<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $genders = [
            [
                'id' => 1,
                'gender' => 'Laki - Laki',
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'gender' => 'Perempuan',
                'visible' => true,
                'delete' => false,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('genders')->insert($genders);
    }
}
