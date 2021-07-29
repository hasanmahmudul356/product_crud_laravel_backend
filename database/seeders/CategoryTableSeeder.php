<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $datalist = [
            ['title' => 'Mobile'],
            ['title' => 'Laptop'],
            ['title' => 'Three paces'],
            ['title' => 'General Food'],
            ['title' => 'Baby Food']
        ];

        Category::insert($datalist);

        echo "Category Seed Complete \n";
    }
}
