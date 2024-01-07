<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Product::create([
        'title' => 'Id ipsum est culpa non aute fugiat ea ullamco nulla aliquip quis.',
        'price'=>19.03,
        'quantity'=>3,
        'category_id'=>1,
        'brand_id'=>1,
        'description'=>'Eiusmod laborum magna qui labore labore proident. Enim in voluptate in sunt nulla nisi consequat amet commodo reprehenderit magna. Cillum commodo eu nulla laborum consequat incididunt. Aliqua sit fugiat aliquip Lorem duis. Nostrud duis cillum excepteur id ipsum officia irure consequat quis esse ut ipsum. Nostrud occaecat ut et minim ullamco laborum officia consequat reprehenderit quis exercitation sit. Officia officia incididunt Lorem cillum.'
       ]);
    }
}
