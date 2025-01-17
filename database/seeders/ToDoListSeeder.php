<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ToDoList;
use Illuminate\Database\Seeder;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ToDoList::insert([
            [
                'title' => 'Title 1',
                'description' => 'Description 1',
                'is_done' => false
            ],
            [
                'title' => 'Title 2',
                'description' => 'Description 2',
                'is_done' => true
            ]
        ]);
    }
}
