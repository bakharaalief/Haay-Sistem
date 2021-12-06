<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'level' => 1,
            'gender' => 'L',
            'password' => bcrypt('12345678')
        ]);

        //create user
        User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'level' => 2,
            'gender' => 'P',
            'password' => bcrypt('12345678')
        ]);
    }
}
