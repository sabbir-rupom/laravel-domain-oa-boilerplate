<?php

namespace App\Domains\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'code' => 'P1',
                'stock' => 10,
                'price' => 100 
            ],
            [
                'name' => 'Product 2',
                'code' => 'P2',
                'stock' => 15,
                'price' => 45 
            ],
        ]);
    }
}
