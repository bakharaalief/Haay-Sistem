<?php

namespace Database\Seeders;

use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();

        $dt = Carbon::now()->setTimezone('Asia/Manila');
        $dateNow = $dt->toDateTimeString();
        $levels = [
            [
                'id' => 1,
                'level' => 'Admin',
                'visible' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'id' => 2,
                'level' => 'Customer',
                'visible' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]
        ];

        DB::table('levels')->insert($levels);
    }
}
