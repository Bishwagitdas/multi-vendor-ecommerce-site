<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'a@a.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //Vendor
            [
                'name' => 'Vendor',
                'username' => 'vendor',
                'email' => 'v@v.com',
                'password' => Hash::make('111'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            //User
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'u@u.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);

    }
}
