<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('112352935'),
            'role_as' => '1'
        ]);

        DB::table('client')->insert([
            'id' => 'd03a7f43-f1e3-47b0-8a61-21e79df08c7f',
            'shop_name' => 'Molly Electronics',
            'shop_address' => 'Монгол улсад байгаа олоод ирээрэй хө',
            'shop_logo' => 'uploads/shopdata/logo.png',
            'email' => 'test@test.com',
            'account_number' => '5000500050',
            'account_name' => 'Molly ХХК',
            'phone_number' => '99119911',
            'working_hour' => '09:00-20:00',
            'google_map_link' => 'https://goo.gl/maps/FL7YX5Vm8zXZ8TS59',
            'facebook_link' => 'https://www.facebook.com/mollyelectronics',
            'instagram_link' => 'https://www.instagram.com/molly.electronics?fbclid=IwAR2bYK7bMJly2tuMCrrZqMB6THdfNDJ0kkfwkNfhrFhSrWcPjZQynFG9MT0',
        ]);

        DB::table('banner')->insert([
           'id' => '6a847aa8-b157-4bb7-81aa-b8d7e58d0382',
           'image' => 'uploads/banner/test_banner.png'
        ]);

    }
}
