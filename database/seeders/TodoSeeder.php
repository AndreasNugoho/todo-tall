<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('todos')->insert([
             [
                'title' => 'Mengerjakan Task 1',
                'user_id' => 2
             ],
             [
                'title' => 'Mengerjakan Task 2',
                'user_id' => 2
             ],
             [
                'title' => 'Mengerjakan Task 3',
                'user_id' => 3
             ],
             [
                'title' => 'Mengerjakan Task 4',
                'user_id' => 1
             ],
             [
                'title' => 'Mengerjakan Task 5',
                'user_id' => 2
             ],
             [
                'title' => 'Mengerjakan Task 6',
                'user_id' => 2
             ],
             [
                'title' => 'Mengerjakan Task 7',
                'user_id' => 3
             ],

        ]);
    }
}
