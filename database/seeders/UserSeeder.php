<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            //admin
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
           [
                'name' => 'andre',
                'email' => 'andre@example.com',
                'password' => Hash::make('andre'),
                'role' => 'user',

            ],
            [
                'name' => 'adnan',
                'email' => 'adnan@example.com',
                'password' => Hash::make('adnan'),
                'role' => 'user',

            ],
            [
                'name' => 'testing',
                'email' => 'testing@example.com',
                'password' => Hash::make('testing'),
                'role' => 'user',

            ],

        ]);
    }
}
