<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [];

        $input['role_id'] = 1;
        $input['email'] = 'mplussoftesting@gmail.com';
        $input['password'] = Hash::make('12345678');
        $input['state_id'] = 1;
        $input['city_id'] = 3;

        DB::table('Arm_master_admins')->insert($input);
    }
}
