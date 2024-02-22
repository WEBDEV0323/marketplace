<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'masroor@gmail.com',
            'password' => Hash::make('Discover@123'),
        ]); 
         
        DB::table('user_types')->insert([
            'name' => 'user',
            
        ]);
        DB::table('user_types')->insert([
            'name' => 'vendor',
        ]);  
    }
}
