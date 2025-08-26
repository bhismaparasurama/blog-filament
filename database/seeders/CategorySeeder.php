<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Frontend', 'Backend', 'Fullstack', 'Mobile', 'UI/UX'];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }
    }
}
