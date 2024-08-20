<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            'name' => 'Todo',
            'created_at' => now(),
        ]);
        Category::insert([
            'name' => 'InProgress',
            'created_at' => now(),
        ]);
        Category::insert([
            'name' => 'Testing',
            'created_at' => now(),
        ]);
        Category::insert([
            'name' => 'Done',
            'created_at' => now(),
        ]);
        Category::insert([
            'name' => 'Pending',
            'created_at' => now(),
        ]);
    }
}
