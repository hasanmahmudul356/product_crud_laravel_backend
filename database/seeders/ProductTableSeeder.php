<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datalist = [
            [
                'category_id' => '1',
                'title' => 'itel Vision 2 Plus',
                'description' => 'Details of itel Vision 2 Plus',
                'price' => '15000'
            ],
            [
                'category_id' => '2',
                'title' => 'ASUS 21',
                'description' => 'ASUS 21',
                'price' => '50000'
            ],
            [
                'category_id' => '3',
                'title' => 'indian Cutton',
                'description' => 'Details of indian Cutton',
                'price' => '500'
            ],
            [
                'category_id' => '4',
                'title' => 'Medicate Rice',
                'description' => 'Details of Medicate Rice',
                'price' => '100'
            ],
            [
                'category_id' => '4',
                'title' => 'Mosur Daul',
                'description' => 'Mosur Daul',
                'price' => '100'
            ],
        ];

        Product::insert($datalist);

        echo "Product Seed Complete \n";
    }
}
